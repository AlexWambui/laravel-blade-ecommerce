<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 real users with specific details
        $admin_password = 'r00t';
        $user_password = 'password';

        $realUsers = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Root',
                'email' => 'admin@gmail.com',
                'password' => $admin_password,
                'user_level' => 0,
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin1@gmail.com',
                'password' => $user_password,
                'user_level' => 1,
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'password' => $user_password,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael.brown@example.com',
                'password' => $user_password,
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Johnson',
                'email' => 'emily.johnson@example.com',
                'password' => $user_password,
            ],
        ];

        foreach ($realUsers as $user) {
            User::factory()->create($user);
        }

        // Create 10 fake users
        User::factory(10)->create();
    }
}
