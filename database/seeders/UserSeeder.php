<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedData = [
            [
                'name' => 'Akbar',
                'email' => 'akbar@gmail.com',
                'password' => bcrypt('password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
                
            ],
            [
                'name' => 'John',
                'email' => 'john@example.com',
                'password' => bcrypt('secret123'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
               
            ],
            // Add more entries as needed...
            [
                'name' => 'User3',
                'email' => 'user3@example.com',
                'password' => bcrypt('user3password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
                
            ],
            [
                'name' => 'User4',
                'email' => 'user4@example.com',
                'password' => bcrypt('user4password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
               
            ],
            [
                'name' => 'User5',
                'email' => 'user5@example.com',
                'password' => bcrypt('user5password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
            ],
            [
                'name' => 'User6',
                'email' => 'user6@example.com',
                'password' => bcrypt('user6password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
            ],
            [
                'name' => 'User7',
                'email' => 'user7@example.com',
                'password' => bcrypt('user7password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
            ],
            [
                'name' => 'User8',
                'email' => 'user8@example.com',
                'password' => bcrypt('user8password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
            ],
            [
                'name' => 'User9',
                'email' => 'user9@example.com',
                'password' => bcrypt('user9password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,
            ],
            [
                'name' => 'User10',
                'email' => 'user10@example.com',
                'password' => bcrypt('user10password'),
                'address' => '123 Main Street',
                'country' => 'United States',
                'city' => 'New York',
                'street' => 'Broadway',
                'phone_number' => 1234567890,   
            ],
        ];
    
        DB::table('users')->insert($seedData);
    }
    
}
