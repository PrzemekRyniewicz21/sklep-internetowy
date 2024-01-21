@extends('layouts.app')

@section('content')
<div class="container">

    @include('helpers.messages')

    <div class="row">
        <div class="col-6">
            <h1><i class="fa-solid fa-list"></i> Orders</h1>
        </div>
        <div class="col-6">
            <a href="{{ route('products-create') }}" class="float-right">
                <button class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
        </div>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Product</th>
                    <th scope="col">Address data</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
            <tbody>
                <tr>

                    <th scope="row">{{ $order->id }}</th>
                    <th scope="row">{{ $order->quantity}}</th>
                    <th scope="row">{{ $order->price}}</th>


                    <th scope="row">
                        @foreach($order->products as $product)
                        <ul>
                            <li>{{$product->name}}</li>
                        </ul>
                        @endforeach
                    </th>

                    <th scope="row">
                        <li>Name: {{ $order->user->name ?? 'X' }} {{ $order->user->surname ?? 'X' }}</li>
                        <li>City: {{ $order->user->address->city ?? 'X' }}</li>
                        <li>Street: {{ $order->user->address->street ?? 'X' }}</li>
                        <li>Home nr: {{ $order->user->address->home_no ?? 'X' }}</li>
                        <li>Zip code: {{ $order->user->address->zip_code ?? 'X' }}</li>

                    </th>
                    <th scope="row">
                        @if($order->status == "sent")
                        <button id="change-status" class="btn btn-outline-success btn-success" value="{{ $order->id }}" disabled>
                            Sent!
                        </button>
                        @else
                        <button id="change-status" class="btn btn-outline-info" value="{{ $order->id }}">
                            Send
                        </button>
                        @endif
                    </th>

                </tr>
            </tbody>
            @endforeach

        </table>
    </div>
</div>
@endsection
@section('js-files')
<script src="{{ asset('js/welcome.js') }}"></script>

@endsection