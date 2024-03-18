<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LocationState;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class LocationStateFactory extends Factory
{
    protected $model = LocationState::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
        ];
    }
}
