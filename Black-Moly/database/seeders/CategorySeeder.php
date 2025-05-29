<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'SUV',
                'description' => 'Sport Utility Vehicles, ideal for families and off-road adventures.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sedan',
                'description' => 'Comfortable and efficient vehicles suitable for city and highway use.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hatchback',
                'description' => 'Compact and economical vehicles for daily commutes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Truck',
                'description' => 'Heavy-duty vehicles designed for transport and utility.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electric',
                'description' => 'Eco-friendly vehicles powered by electricity.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Motorbike',
                'description' => 'Two-wheeled vehicles for fast and flexible travel.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
