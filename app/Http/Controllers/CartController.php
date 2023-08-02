<?php

namespace App\Http\Controllers;

use App\ValueObjects\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(Session::get('cart', new Cart()));
        return view('home');
    }

    public function store(Product $product)
    {
        $cart = Session::get('cart', new Cart());
         
        Session::put('cart', $cart->addItem($product));

        return response()->json([
            'status' => 'success',
        ]);
    }
}
