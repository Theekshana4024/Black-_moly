<?php

namespace App\Http\Controllers;

use App\Models\ChatbotQuery;
use Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function processQuery(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json([
                'error' => 'Query cannot be empty'
            ], 400);
        }

        try {
            // Get API key from .env
            $apiKey = config('services.gemini.api_key');

            if (empty($apiKey)) {
                Log::error('Gemini API key is not set');
                return response()->json([
                    'error' => 'API configuration error'
                ], 500);
            }

            // Initialize Gemini client with curl options for local development
            $clientOptions = [];

            // Only disable SSL verification in local environment
            if (app()->environment('local')) {
                $clientOptions = [
                    'client_options' => [
                        'curl' => [
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_SSL_VERIFYHOST => false,
                        ]
                    ]
                ];
            }

            $client = Gemini::client($apiKey, $clientOptions);

            // Use Gemini Flash 2.0 model
            $gemini = $client->generativeModel(model: 'models/gemini-2.0-flash');

            // Send query to Gemini
            $response = $gemini->generateContent($query);
            $botResponse = $response->text();

            if (empty($botResponse)) {
                Log::warning('Empty response received from Gemini API');
                $botResponse = "I'm sorry, I couldn't generate a response at this time.";
            }

            // Store the query and response in database if user is authenticated
            if (auth()->check()) {
                ChatbotQuery::create([
                    'user_id' => auth()->id(),
                    'query' => $query,
                    'response' => $botResponse
                ]);
            }

            // Log success for debugging
            Log::info('Chatbot response generated successfully', [
                'query' => $query,
                'response_length' => strlen($botResponse)
            ]);

            return response()->json([
                'response' => $botResponse
            ]);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Chatbot error: ' . $e->getMessage(), [
                'query' => $query,
                'exception' => $e
            ]);

            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // A simpler test endpoint for debugging
    public function test()
    {
        return response()->json([
            'response' => 'This is a test response from the chatbot API.'
        ]);
    }
}
