<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleImageSeeder extends Seeder
{
    public function run(): void
    {
        // Get the available vehicle IDs
        $vehicles = DB::table('vehicles')->pluck('id');

        $vehicleImages = [
            // Vehicle ID 1 (Toyota Corolla 2020)
            [
                'image_path' => 'images/vehicles/toyota-corolla-2020-1.jpg',
                'is_primary' => true,
                'vehicle_id' => $vehicles->get(0), // First vehicle ID
            ],
            [
                'image_path' => 'images/vehicles/toyota-corolla-2020-2.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(0),
            ],
            [
                'image_path' => 'images/vehicles/toyota-corolla-2020-3.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(0),
            ],

            // Vehicle ID 2 (Honda Civic 2019)
            [
                'image_path' => 'images/vehicles/honda-civic-2019-1.jpg',
                'is_primary' => true,
                'vehicle_id' => $vehicles->get(1), // Second vehicle ID
            ],
            [
                'image_path' => 'images/vehicles/honda-civic-2019-2.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(1),
            ],

            // Vehicle ID 3 (BMW X5 2021)
            [
                'image_path' => 'images/vehicles/bmw-x5-2021-1.jpg',
                'is_primary' => true,
                'vehicle_id' => $vehicles->get(2), // Third vehicle ID
            ],
            [
                'image_path' => 'images/vehicles/bmw-x5-2021-2.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(2),
            ],
            [
                'image_path' => 'images/vehicles/bmw-x5-2021-3.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(2),
            ],

            // Vehicle ID 4 (Tesla Model S 2022)
            [
                'image_path' => 'images/vehicles/tesla-model-s-2022-1.jpg',
                'is_primary' => true,
                'vehicle_id' => $vehicles->get(3), // Fourth vehicle ID
            ],
            [
                'image_path' => 'images/vehicles/tesla-model-s-2022-2.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(3),
            ],

            // Vehicle ID 5 (Chevrolet Camaro 2020)
            [
                'image_path' => 'images/vehicles/chevrolet-camaro-2020-1.jpg',
                'is_primary' => true,
                'vehicle_id' => $vehicles->get(4), // Fifth vehicle ID
            ],
            [
                'image_path' => 'images/vehicles/chevrolet-camaro-2020-2.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(4),
            ],
            [
                'image_path' => 'images/vehicles/chevrolet-camaro-2020-3.jpg',
                'is_primary' => false,
                'vehicle_id' => $vehicles->get(4),
            ],
        ];

        // Insert the vehicle images into the 'vehicle_images' table
        DB::table('vehicle_images')->insert($vehicleImages);
    }
}
