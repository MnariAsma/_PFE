<?php

namespace Database\Factories;
use App\Models\LocationCity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LocationCity>
 */
class LocationCityFactory extends Factory
{
    protected $model = LocationCity::class;

    public function definition()
    {
        return [
            'state_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->unique()->city,
        ];
    }
}
