@extends('layouts.app')

@section('content')
<div class="container">

    @include('helpers.messages')

    <div class="row">
        <div class="col-6">
            <h1><i class="fa-solid fa-list"></i> Product list</h1>
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
                    <th scope="col">Name</th>
                    <th scope="col">Short description</th>
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
                    <td>@if($product->hasCategory()) {{ $product->category->name }} @else X @endif</td>
                    <td>
                        <a href="{{ route('products-show', $product->id) }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </a>

                        <a href="{{ route('products-edit', $product->id) }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                        </a>

                        <form style="float:right" action="{{ route('product-delete', $product->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten produkt?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm delete">
                                <i class="fa-solid fa-trash"></i>
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