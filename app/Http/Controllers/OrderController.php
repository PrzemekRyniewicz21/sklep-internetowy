<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::where('user_id', Auth::id())->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $cart = Session::get('cart', new Cart());
        $order = new Order();
        $order->amount = $cart->getQuantity();
        $order->price = $cart->getSum();
        $order->user_id = Auth::id();
        $order->save();

        // dd($cart->getItems()->map(function($item){
        //     return $item->getProductId();
        // }));

        $productsIds = $cart->getItems()->map(function($item){
            return [
                'product_id' => $item->getProductId()
            ];
        });

        $order->products()->attach($productsIds);

        // 'czyscimy' koszyk
        Session::put('cart', new Cart()); 

        return redirect(route('order.index'))->with('status','success order');
    }

  
}
