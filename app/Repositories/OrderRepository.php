<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\ValueObjects\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class OrderRepository implements OrderRepositoryInterface
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function allOrders()
    {
        return $this->order->all();
    }

    /**
     * Zwraca zamówienia konkretnego user'a
     *
     * @param int $id_usera
     * @return Order 
     */

    public function getUserOrders(int $id_usera): Order
    {
        return $this->order->where('user_id', $id_usera)->get();
    }

    public function store(): RedirectResponse
    {
        $cart = Session::get('cart', new Cart());
        $order = new Order();
        $order->amount = $cart->getQuantity();
        $order->price = $cart->getSum();
        $order->quantity = $cart->getQuantity();
        $order->user_id = Auth::id();
        $order->save();

        $productsIds = $cart->getItems()->map(function ($item) {
            return [
                'product_id' => $item->getProductId()
            ];
        });

        $order->products()->attach($productsIds);

        // 'czyscimy' koszyk
        Session::put('cart', new Cart());

        return redirect(route('order.index'))->with('status', 'success order');
    }
}
