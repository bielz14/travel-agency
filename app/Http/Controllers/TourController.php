<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Country;
use App\Models\City;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with(['country','city','hotel']);

        // Пошук по назві
        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Країна
        if ($request->country_id) {
            $query->where('country_id', $request->country_id);
        }

        // Ціна
        if ($request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        // Дати (between start_date і end_date)
        if ($request->start_date) {
            $query->where('start_date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->where('end_date', '<=', $request->end_date);
        }

        // Кількість гостей
        if ($request->guests && $request->guests > 0) {
            $query->where('max_guests', '>=', $request->guests);
        }

        // Сортування по ціні
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $tours = $query->paginate(10);
        $countries = Country::all();
        $cities = City::all();

        return view('tours.index',compact('tours','countries','cities'));
    }

    public function show($id)
    {
        $tour = Tour::with(['country','city','hotel','reviews'])->findOrFail($id);

        return view('tours.show',compact('tour'));
    }
}
