<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name'=>fake()->name(),
            'generated_code'=>Client::RandomizeCode(),
            'company_name'=>fake()->name(),
            'created_at'=>fake()->dateTimeBetween('-1 year','now'),
            'updated_at'=>now()
        ];
    }
}
