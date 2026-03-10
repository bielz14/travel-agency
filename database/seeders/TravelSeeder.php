<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Tour;

class TravelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Indonesia' => ['Bali', 'Jakarta', 'Lombok'],
            'Thailand' => ['Bangkok', 'Phuket', 'Chiang Mai'],
            'Italy' => ['Rome', 'Venice', 'Florence'],
            'Spain' => ['Barcelona', 'Madrid', 'Seville'],
            'Mexico' => ['Cancun', 'Tulum', 'Mexico City'],
            'France' => ['Paris', 'Nice', 'Lyon'],
            'Japan' => ['Tokyo', 'Kyoto', 'Osaka'],
            'Greece' => ['Santorini', 'Athens', 'Mykonos'],
        ];

        foreach ($data as $countryName => $cities) {
            // Створюємо країну
            $country = Country::factory()->create([
                'name' => $countryName
            ]);

            foreach ($cities as $cityName) {
                // Створюємо місто і прив’язуємо його до країни
                $city = City::factory()->create([
                    'name' => $cityName,
                    'country_id' => $country->id
                ]);

                // Створюємо 3 готелі для цього міста
                Hotel::factory(3)->create([
                    'city_id' => $city->id,
                    'name' => fn() => $cityName . ' Resort ' . fake()->unique(true)->numberBetween(1, 3)
                ])->each(function ($hotel) use ($country, $city) {
                    // Для кожного готелю створюємо 1 тур
                    Tour::factory()->create([
                        'country_id' => $country->id,
                        'city_id' => $city->id,
                        'hotel_id' => $hotel->id,
                    ]);
                });
            }
        }
    }
}
