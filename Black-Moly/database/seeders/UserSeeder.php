<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch role IDs from the roles table
        $roles = DB::table('roles')->pluck('id', 'name'); // ['admin' => 1, 'user' => 2, ...]

        // Users list
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role_name' => 'admin',
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'role_name' => 'user',
                'telephone' => '0777890123',
                'address' => 'Kandy, Sri Lanka',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password123'),
                'role_name' => 'super admin',
            ],
        ];

        foreach ($users as $user) {
            // Get the role_id from the roles table
            $roleId = $roles[$user['role_name']] ?? null;

            if (!$roleId) {
                continue; // Skip user if role not found
            }

            $userId = DB::table('users')->insertGetId([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role_id' => $roleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Only insert user_contacts if role is 'user'
            if ($user['role_name'] === 'user') {
                DB::table('user_contacts')->insert([
                    'user_id' => $userId,
                    'telephone' => $user['telephone'],
                    'address' => $user['address'],
                ]);
            }
        }
    }
}
