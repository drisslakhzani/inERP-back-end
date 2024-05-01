<?php

// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate multiple fake admin records
        for ($i = 0; $i < 10; $i++) {
            Admin::create([
                'adminName' => $faker->name,
                'login' => $faker->userName,
                'password' => Hash::make($faker->password),
                'phoneNumber' => $faker->phoneNumber,
                'whatsappNumber' => $faker->phoneNumber,
                'email' => $faker->email,
                'facebook' => $faker->userName,
                'instagram' => $faker->userName,
                'linkedIn' => $faker->userName,
                'twitter' => $faker->userName,
                'locationAddress' => $faker->address,
            ]);
        }
    }
}

