<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // Validate Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'new_password' => 'required|string|min:8|same:confirm_password',// updated to match form field names
            'telephone' => 'required|min:10|max:10',
            'address' => 'required|string|max:500',
        ]);

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->new_password), // Hash the password
            'role_id'  => 2,
        ]);

        // Create contact info
        UserContact::create([
            'telephone' => $request->telephone,
            'address'   => $request->address,
            'user_id'   => $user->id,
        ]);

        // Authenticate the user
        Auth::login($user);

        // Redirect with success message
        return redirect()->route('home')->with('success', 'User registered and logged in successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function loginPage(){
        return view('customer.pages.login');
    }
    public function registerPage(){
        return view('customer.pages.login');
    }

    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Get authenticated user
            $user = Auth::user();

            // Redirect based on role
            if ($user->role && $user->role->name === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
            } elseif ($user->role && $user->role->name === 'user') {
                return redirect()->route('home')->with('success', 'Login successful');
            }

            // Default redirect
            return redirect()->route('home')->with('success', 'Login successful');
        }

        // If login fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
