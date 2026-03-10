<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tour;
use App\Models\Country;
use App\Models\City;
use App\Models\Hotel;

class TourFactory extends Factory
{
    protected $model = Tour::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 days', '+3 months');
        $end = (clone $start)->modify('+' . $this->faker->numberBetween(5, 14) . ' days');

        $images = [
            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
            'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
            'https://images.unsplash.com/photo-1501785888041-af3ef285b470',
            'https://images.unsplash.com/photo-1470770841072-f978cf4d019e',
            'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429',
        ];

        $titles = [
            'Luxury Beach Escape',
            'Ultimate Adventure Tour',
            'Romantic Getaway',
            'Exotic Paradise Experience',
            'Premium Travel Package',
            'Island Discovery Tour',
            'Cultural Exploration Journey'
        ];

        $active = Tour::ACTIVE;

        return [
            'title' => $titles[array_rand($titles)],
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->numberBetween(500, 4000),
            'start_date' => $start,
            'end_date' => $end,
            'active' => $active,
            'country_id' => Country::factory(),
            'city_id' => City::factory(),
            'hotel_id' => Hotel::factory(),
            'image' => $images[array_rand($images)],
        ];
    }
}
