<?php

namespace App\Http\Controllers;

use App\Models\Tour;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart',[]);

        return view('cart.index',compact('cart'));
    }

    public function add(Tour $tour)
    {
        $cart = session()->get('cart',[]);

        $cart[$tour->id] = $tour;

        session()->put('cart',$cart);

        return back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back();
    }
}
