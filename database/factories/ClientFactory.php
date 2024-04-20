<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->firstName(),
            'companyName' => $this->faker->company(),
            'phoneNumber' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'generatedCode' => Str::random(10),
        ];
    }
}
