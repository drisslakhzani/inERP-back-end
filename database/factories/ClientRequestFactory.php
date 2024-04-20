<?php

namespace Database\Factories;

use App\Models\ClientRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate an array of sentences (5 sentences)
        $selectedSolutions = [];
        for ($i = 0; $i < 5; $i++) {
            $selectedSolutions[] = $this->faker->sentence();
        }

        return [
            'selectedSolutions' => $selectedSolutions,
            'solutionType' => $this->faker->word(),
            'clients_id' => function () {
                return \App\Models\Client::factory()->create()->id;
            },
            'status' => $this->faker->boolean(),
        ];
    }
}
