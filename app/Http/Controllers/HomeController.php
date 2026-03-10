<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Country;
use App\Models\City;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        // Отримуємо тури для головної сторінки з уникальними комбанціями country и city
        $tours = Tour::with(['country', 'city'])
            ->whereIn('id', function($query) {
                $query->selectRaw('MIN(id)')
                    ->from('tours')
                    ->groupBy('country_id', 'city_id');
            })
            ->get();

        // Групуємо по країні
        $grouped = $tours->groupBy('country_id')->values();

        // Round-robin: беремо по одному з кожної групи
        $result = collect();
        $maxCount = $grouped->max(fn($g) => $g->count());

        for ($i = 0; $i < $maxCount; $i++) {
            foreach ($grouped as $group) {
                if (isset($group[$i])) {
                    $result->push($group[$i]);
                }
            }
        }

        // Пагінація вручну
        $page = request()->get('page', 1);
        $perPage = 9;
        $tours = new \Illuminate\Pagination\LengthAwarePaginator(
            $result->forPage($page, $perPage),
            $result->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Для шапки передаємо список країн та міст
        $countries = Country::all();
        $cities = City::all();

        return view('home', compact('tours', 'countries', 'cities'));
    }
}
