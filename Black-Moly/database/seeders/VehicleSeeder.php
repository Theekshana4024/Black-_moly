<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // Get the available models and users
        $models = DB::table('models')->pluck('id');
        $users = DB::table('users')->pluck('id');

        $vehicles = [
            [
                'title' => 'Toyota Corolla 2020',
                'slug' => 'toyota-corolla-2020',
                'year' => 2020,
                'price' => 18000.00,
                'mileage' => 25000.00,
                'fuel_type' => 'petrol',
                'transmission' => 'auto',
                'condition' => 'used',
                'location' => 'New York, NY',
                'description' => 'A reliable and efficient sedan with great fuel economy.',
                'status' => 'available',
                'model_id' => $models->first(), // First model ID (Corolla)
                'user_id' => $users->first(), // First user ID
            ],
            [
                'title' => 'Honda Civic 2019',
                'slug' => 'honda-civic-2019',
                'year' => 2019,
                'price' => 17000.00,
                'mileage' => 30000.00,
                'fuel_type' => 'diesel',
                'transmission' => 'manual',
                'condition' => 'pre-owned',
                'location' => 'Los Angeles, CA',
                'description' => 'A compact car with sporty handling and great fuel efficiency.',
                'status' => 'sold',
                'model_id' => $models->get(1), // Second model ID (Civic)
                'user_id' => $users->get(2), // Second user ID
            ],
            [
                'title' => 'BMW X5 2021',
                'slug' => 'bmw-x5-2021',
                'year' => 2021,
                'price' => 65000.00,
                'mileage' => 10000.00,
                'fuel_type' => 'diesel',
                'transmission' => 'auto',
                'condition' => 'new',
                'location' => 'Chicago, IL',
                'description' => 'A luxury SUV with a perfect blend of performance and comfort.',
                'status' => 'pending',
                'model_id' => $models->get(3), // Third model ID (BMW X5)
                'user_id' => $users->get(2), // Third user ID
            ],
            [
                'title' => 'Tesla Model S 2022',
                'slug' => 'tesla-model-s-2022',
                'year' => 2022,
                'price' => 85000.00,
                'mileage' => 5000.00,
                'fuel_type' => 'electric',
                'transmission' => 'auto',
                'condition' => 'new',
                'location' => 'San Francisco, CA',
                'description' => 'An all-electric luxury sedan known for its top-tier performance and technology.',
                'status' => 'available',
                'model_id' => $models->get(4), // Fourth model ID (Tesla Model S)
                'user_id' => $users->get(2), // Fourth user ID
            ],
            [
                'title' => 'Chevrolet Camaro 2020',
                'slug' => 'chevrolet-camaro-2020',
                'year' => 2020,
                'price' => 35000.00,
                'mileage' => 12000.00,
                'fuel_type' => 'petrol',
                'transmission' => 'manual',
                'condition' => 'used',
                'location' => 'Miami, FL',
                'description' => 'A powerful muscle car with bold styling and impressive performance.',
                'status' => 'sold',
                'model_id' => $models->get(5), // Fifth model ID (Chevrolet Camaro)
                'user_id' => $users->get(2), // Fifth user ID
            ],
        ];

        // Insert the vehicles into the 'vehicles' table
        DB::table('vehicles')->insert($vehicles);
    }
}
