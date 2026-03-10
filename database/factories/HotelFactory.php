<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;
use App\Models\City;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Resort',
            'city_id' => City::factory(), // зв'язок із фабрикою City
            'stars' => $this->faker->numberBetween(3, 5),
            'description' => $this->faker->paragraph,
        ];
    }
}
