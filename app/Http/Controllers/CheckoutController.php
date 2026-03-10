<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Кошик порожній');
        }

        $user  = Auth::user();
        $total = collect($cart)->sum('price');

        return view('checkout.index', compact('cart', 'user', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $request->validate([
            'guests' => 'required|integer|min:1|max:50',
        ], [
            'guests.required' => 'Вкажіть кількість гостей',
            'guests.min'      => 'Мінімум 1 гість',
            'guests.max'      => 'Максимум 50 гостей',
        ]);

        $user     = Auth::user();
        $guests   = (int) $request->guests;
        $bookings = [];

        foreach ($cart as $tour) {
            $bookings[] = Booking::create([
                'user_id'     => $user->id,
                'tour_id'     => $tour->id,
                'guests'      => $guests,
                'guest_email' => $user->email,
                'guest_phone' => $user->phone,
                'total_price' => $tour->price * $guests,
                'status'      => 'pending',
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', ['booking' => $bookings[0]->id]);
    }

    public function success(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('booking'));
    }
}
