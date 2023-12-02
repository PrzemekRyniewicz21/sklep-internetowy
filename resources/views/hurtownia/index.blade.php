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
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            @foreach ($products as $product)
            <tbody>
                <tr class="access_js" id="{{ $product['id'] }}">
                    <td name="id">{{ $product['id']}}</td>
                    <td name="name_">{{ $product['name']}}</td>
                    <td name="description">{{ $product['description']}}</td>
                    <td name="amount">{{ $product['amount']}}</td>
                    <td name="price">{{ $product['price']}}</td>
                    <td name="category">{{ $product['category']}}</td>
                    <td>

                        <button class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>

                        </button>

                    </td>
                </tr>
            </tbody>
            @endforeach

        </table>
    </div>
</div>
<script src="{{ asset('js\hurtownia.js') }}"></script>
@endsection