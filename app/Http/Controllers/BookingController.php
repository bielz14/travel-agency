<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        Booking::create($request->all());

        return redirect()->back()->with('success','Заявка отправлена');
    }
}
