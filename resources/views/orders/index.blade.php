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
                            <li>{{$product->name}} -- {{$product->description}}</li>
                        </ul>
                    @endforeach
                </th>
            </tr>
        </tbody>
        @endforeach

    </table>
   </div>
    {{ $orders->links() }}
</div>
@endsection


