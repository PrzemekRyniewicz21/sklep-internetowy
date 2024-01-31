<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;

interface OrderRepositoryInterface
{
    public function allOrders();

    /**
     * Get orders for a specific user.
     *
     * @param int $userId
     * @return Order
     */
    public function getUserOrders(int $userId): Order;

    /**
     * Store a new order.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse;
}
