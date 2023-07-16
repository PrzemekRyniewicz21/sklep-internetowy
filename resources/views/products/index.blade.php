@extends('layouts.app')

@section('content')
<div class="container">

    <!-- @if (null !== (Session::get('msg')))
        <div class="alert alert-success  text-lg-center">
            <h1>{{Session::get('msg')}}</h1>
        </div>
    @endif -->

    <div class="row">
        <div class="col-6">
            <h1>Product list</h1>
        </div>
        <div class="col-6">
            <a href="{{ route('products-create') }}" class="float-right">
                <button class="btn btn-primary">Add</button>
            </a>
        </div>
    </div>

   <div class="row">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>

        </tr>
        </thead>
        @foreach ($products as $product)
        <tbody>
            <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name}}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->amount}}</td>
            <td>{{ $product->price}}</td>
            <td>@if($product->hasCategory()) {{ $product->category->name }} @endif</td>
            <td>
                <a href="{{ route('products-show', $product->id) }}">
                    <button class="btn btn-primary btn-sm">
                        P
                    </button>
                </a>

                <a href="{{ route('products-edit', $product->id) }}">
                    <button class="btn btn-primary btn-sm">
                        E
                    </button>
                </a>

                <form action="{{ route('product-delete', $product->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten produkt?')">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm delete">
                        X
                    </button>
                </form>
                
            </td>
        </tbody>
        @endforeach

    </table>
   </div>
    {{ $products->links() }}
</div>
@endsection


