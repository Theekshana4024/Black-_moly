<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleComparisonSeeder extends Seeder
{
    public function run(): void
    {
        // Get the available vehicle IDs
        $vehicles = DB::table('vehicles')->pluck('id');

        // Sample vehicle comparisons to insert into the database
        $vehicleComparisons = [
            // User 2 comparing vehicles 1, 2, and 3
            [
                'user_id' => 2, // Normal user ID (2)
                'vehicle_compared' => json_encode([
                    'vehicle_ids' => [$vehicles->get(0), $vehicles->get(1), $vehicles->get(2)],
                    'comparison_criteria' => [
                        'price' => ['vehicle_1' => 25000, 'vehicle_2' => 22000, 'vehicle_3' => 35000],
                        'mileage' => ['vehicle_1' => 25000, 'vehicle_2' => 18000, 'vehicle_3' => 35000],
                        'fuel_type' => ['vehicle_1' => 'diesel', 'vehicle_2' => 'petrol', 'vehicle_3' => 'electric'],
                        'condition' => ['vehicle_1' => 'used', 'vehicle_2' => 'used', 'vehicle_3' => 'new'],
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User 2 comparing vehicles 4 and 5
            [
                'user_id' => 2, // Normal user ID (2)
                'vehicle_compared' => json_encode([
                    'vehicle_ids' => [$vehicles->get(3), $vehicles->get(4)],
                    'comparison_criteria' => [
                        'price' => ['vehicle_4' => 60000, 'vehicle_5' => 30000],
                        'mileage' => ['vehicle_4' => 15000, 'vehicle_5' => 22000],
                        'fuel_type' => ['vehicle_4' => 'electric', 'vehicle_5' => 'petrol'],
                        'condition' => ['vehicle_4' => 'new', 'vehicle_5' => 'pre-owned'],
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User 2 comparing vehicles 2 and 3
            [
                'user_id' => 2, // Normal user ID (2)
                'vehicle_compared' => json_encode([
                    'vehicle_ids' => [$vehicles->get(1), $vehicles->get(2)],
                    'comparison_criteria' => [
                        'price' => ['vehicle_1' => 22000, 'vehicle_2' => 35000],
                        'mileage' => ['vehicle_1' => 18000, 'vehicle_2' => 35000],
                        'fuel_type' => ['vehicle_1' => 'petrol', 'vehicle_2' => 'electric'],
                        'condition' => ['vehicle_1' => 'used', 'vehicle_2' => 'new'],
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert the vehicle comparisons into the 'vehicle_comparisons' table
        DB::table('vehicle_comparisons')->insert($vehicleComparisons);
    }
}
