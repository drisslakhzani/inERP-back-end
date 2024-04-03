<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFatoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numSentences = rand(1, 5); // Generate a random number of sentences
        $sentences = [];
        for ($i = 0; $i < $numSentences; $i++) {
            $sentences[] = $this->faker->sentence;
        }

        return [
            'service_needed' => $sentences,
            'clients_id' => \App\Models\Client::factory(),
            'status' => $this->faker->boolean,
        ];
    }
}
