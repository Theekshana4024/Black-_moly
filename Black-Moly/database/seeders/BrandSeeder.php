<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Toyota',
                'description' => 'A reliable and well-established automobile manufacturer known for fuel-efficient cars and trucks.'
            ],
            [
                'name' => 'Honda',
                'description' => 'A Japanese brand known for producing reliable, affordable, and fuel-efficient vehicles.'
            ],
            [
                'name' => 'Ford',
                'description' => 'An American brand famous for its trucks, SUVs, and muscle cars, such as the Ford Mustang.'
            ],
            [
                'name' => 'BMW',
                'description' => 'A German luxury car manufacturer known for producing premium vehicles with excellent performance.'
            ],
            [
                'name' => 'Mercedes-Benz',
                'description' => 'A leading German automaker known for its luxury cars, performance vehicles, and innovative technology.'
            ],
            [
                'name' => 'Audi',
                'description' => 'A German luxury brand known for its sleek designs, advanced technology, and powerful engines.'
            ],
            [
                'name' => 'Chevrolet',
                'description' => 'An American brand offering a wide range of vehicles, from compact cars to full-sized trucks.'
            ],
            [
                'name' => 'Tesla',
                'description' => 'A pioneer in electric vehicles (EVs), known for its high-performance electric cars and self-driving technology.'
            ],
        ];

        DB::table('brands')->insert($brands);
    }
}
