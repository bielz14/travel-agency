<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        Review::create($request->all());

        return redirect()->back()->with('success','Отзыв добавлен');
    }
}
