<?php

namespace Database\Factories;

use App\Models\ClientRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numSentences = $this->faker->numberBetween(1, 5);
        
        // Generate an array of random sentences with values between 1 and 100
        $services = [];
        for ($i = 0; $i < $numSentences; $i++) {
            $service = $this->faker->sentence();
            $values = [
                $this->faker->numberBetween(1, 100),
                $this->faker->numberBetween(1, 100),
            ];
            $services[$service] = $values;
        }

        return [
            'clients_id' => null,
            'sage' => json_encode($services),
            'infrastructure' => json_encode($services),
            'microsoft' => json_encode($services),
            'material' => json_encode($services), 
            'status' => fake()->boolean(),
        ];
    }
}

