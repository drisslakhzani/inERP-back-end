<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'adminName' => $this->faker->name,
            'login' => $this->faker->userName,
            'password' => bcrypt('password'), // Example password (you may want to use Hash::make for secure passwords)
            'phoneNumber' => $this->faker->phoneNumber,
            'whatsappNumber' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'facebook' => $this->faker->userName,
            'instagram' => $this->faker->userName,
            'linkedIn' => $this->faker->userName,
            'twitter' => $this->faker->userName,
            'locationAddress' => $this->faker->address,
        ];
    }
}

