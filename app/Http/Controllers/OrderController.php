<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        // warunek w if zle wyglada - DO ZROBIENIA
        if (Auth::id() == config('admin.data.id')) {

            return view('orders.admin', [
                'orders' => $this->orderRepository->allOrders(),
                // 'orders' => Order::with('user.address'),
            ]);
        }

        // widok dla zwyklego usera
        return view('orders.index', [
            'orders' => $this->orderRepository->getUserOrders(Auth::id()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        return $this->orderRepository->store();
    }

    public function update(Order $order)
    {
        // Log::channel('debug')->info("Before status update: " . $order->status);
        $order->status = "sent";
        $order->save();
        // Log::channel('debug')->info("After status update: " . $order->status);
    }
}
