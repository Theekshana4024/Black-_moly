<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first two brands and categories from the database
        $brands = DB::table('brands')->pluck('id');
        $categories = DB::table('categories')->pluck('id');

        $models = [
            [
                'name' => 'Corolla',
                'description' => 'A compact sedan from Toyota known for its reliability and efficiency.',
                'brand_id' => $brands->first(), // First brand ID (Toyota)
                'category_id' => $categories->first(), // First category ID
            ],
            [
                'name' => 'Civic',
                'description' => 'A compact car from Honda, offering sportiness and economy.',
                'brand_id' => $brands->get(1), // Second brand ID (Honda)
                'category_id' => $categories->first(), // First category ID
            ],
            [
                'name' => 'Mustang',
                'description' => 'A legendary muscle car from Ford with powerful engine options.',
                'brand_id' => $brands->get(2), // Third brand ID (Ford)
                'category_id' => $categories->get(1), // Second category ID
            ],
            [
                'name' => 'X5',
                'description' => 'A luxury SUV from BMW, known for its performance and comfort.',
                'brand_id' => $brands->get(3), // Fourth brand ID (BMW)
                'category_id' => $categories->get(1), // Second category ID
            ],
            [
                'name' => 'S-Class',
                'description' => 'A flagship luxury sedan from Mercedes-Benz, offering top-tier features.',
                'brand_id' => $brands->get(4), // Fifth brand ID (Mercedes-Benz)
                'category_id' => $categories->get(0), // First category ID
            ],
            [
                'name' => 'A4',
                'description' => 'A compact luxury sedan from Audi, offering refined driving experience.',
                'brand_id' => $brands->get(5), // Sixth brand ID (Audi)
                'category_id' => $categories->get(0), // First category ID
            ],
            [
                'name' => 'Camaro',
                'description' => 'A performance-oriented muscle car from Chevrolet, featuring powerful engines.',
                'brand_id' => $brands->get(6), // Seventh brand ID (Chevrolet)
                'category_id' => $categories->get(1), // Second category ID
            ],
            [
                'name' => 'Model S',
                'description' => 'An all-electric luxury sedan from Tesla, known for its technology and performance.',
                'brand_id' => $brands->get(7), // Eighth brand ID (Tesla)
                'category_id' => $categories->get(0), // First category ID
            ],
        ];

        DB::table('models')->insert($models);
    }
}

