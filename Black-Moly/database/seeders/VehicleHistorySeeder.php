<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleHistorySeeder extends Seeder
{
    public function run(): void
    {
        // Get the available vehicle IDs
        $vehicles = DB::table('vehicles')->pluck('id');

        $vehicleHistories = [
            // For Vehicle ID 1 (Toyota Corolla 2020)
            [
                'vehicle_id' => $vehicles->get(0), // First vehicle ID
                'accidents' => 1,
                'service_records' => json_encode([
                    'last_service' => '2023-08-01',
                    'next_service_due' => '2024-08-01',
                    'services' => [
                        'oil_change' => '2023-08-01',
                        'brake_check' => '2023-06-01',
                    ],
                ]),
                'ownership_count' => 2,
                'actual_mileage' => 25000,
                'has_flood_damage' => false,
                'has_salvage_title' => false,
                'notes' => 'Regular maintenance. No accidents reported.',
            ],

            // For Vehicle ID 2 (Honda Civic 2019)
            [
                'vehicle_id' => $vehicles->get(1), // Second vehicle ID
                'accidents' => 0,
                'service_records' => json_encode([
                    'last_service' => '2023-10-15',
                    'next_service_due' => '2024-10-15',
                    'services' => [
                        'tire_rotation' => '2023-09-01',
                        'oil_change' => '2023-10-15',
                    ],
                ]),
                'ownership_count' => 1,
                'actual_mileage' => 18000,
                'has_flood_damage' => false,
                'has_salvage_title' => false,
                'notes' => 'Vehicle has been kept in good condition, no accidents.',
            ],

            // For Vehicle ID 3 (BMW X5 2021)
            [
                'vehicle_id' => $vehicles->get(2), // Third vehicle ID
                'accidents' => 2,
                'service_records' => json_encode([
                    'last_service' => '2023-07-30',
                    'next_service_due' => '2024-07-30',
                    'services' => [
                        'engine_check' => '2023-07-30',
                        'oil_change' => '2023-06-10',
                    ],
                ]),
                'ownership_count' => 3,
                'actual_mileage' => 35000,
                'has_flood_damage' => true,
                'has_salvage_title' => false,
                'notes' => 'Flood damage in 2022. Repaired and running smoothly.',
            ],

            // For Vehicle ID 4 (Tesla Model S 2022)
            [
                'vehicle_id' => $vehicles->get(3), // Fourth vehicle ID
                'accidents' => 0,
                'service_records' => json_encode([
                    'last_service' => '2023-09-10',
                    'next_service_due' => '2024-09-10',
                    'services' => [
                        'battery_check' => '2023-09-10',
                        'tire_rotation' => '2023-08-01',
                    ],
                ]),
                'ownership_count' => 1,
                'actual_mileage' => 15000,
                'has_flood_damage' => false,
                'has_salvage_title' => false,
                'notes' => 'No accidents, excellent condition.',
            ],

            // For Vehicle ID 5 (Chevrolet Camaro 2020)
            [
                'vehicle_id' => $vehicles->get(4), // Fifth vehicle ID
                'accidents' => 0,
                'service_records' => json_encode([
                    'last_service' => '2023-08-20',
                    'next_service_due' => '2024-08-20',
                    'services' => [
                        'oil_change' => '2023-08-20',
                        'brake_check' => '2023-05-10',
                    ],
                ]),
                'ownership_count' => 1,
                'actual_mileage' => 22000,
                'has_flood_damage' => false,
                'has_salvage_title' => false,
                'notes' => 'No accidents, one owner, in excellent condition.',
            ],
        ];

        // Insert the vehicle histories into the 'vehicle_histories' table
        DB::table('vehicle_histories')->insert($vehicleHistories);
    }
}
