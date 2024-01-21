@extends('layouts.app')

@section('content')
<div class="container">

    @include('helpers.messages')

    <div class="row">
        <div class="col-6">
            <h1><i class="fa-solid fa-list"></i> Orders</h1>
        </div>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Product</th>
                    <th scope="col">Order status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            @foreach ($orders as $order)
            <tbody>
                <tr>
                    <th scope="row">{{ $order->quantity}}</th>
                    <th scope="row">{{ $order->price}}</th>

                    <th scope="row">
                        @foreach($order->products as $product)
                        <ul>
                            <li>{{$product->name}}</li>
                        </ul>
                        @endforeach
                    </th>
                    @if($order->status == "sent")
                    <th scope="row">
                        <li>Your order has been sent!</li>
                    </th>
                    <th scope="row">
                        <i class="fa-solid fa-circle-check fa-2xl"></i>
                    </th>
                    @else
                    <th scope="row">
                        <li>We're completing your order- In progress</li>
                    </th>
                    <th scope="row">
                    </th>
                    @endif

                </tr>
            </tbody>
            @endforeach

        </table>
    </div>
</div>
@endsection