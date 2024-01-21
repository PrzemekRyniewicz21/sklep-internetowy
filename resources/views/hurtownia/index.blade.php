@extends('layouts.app')

@section('content')
<div class="container">

    <!-- @include('helpers.messages') -->

    @if(isset($_GET['msg']))
    <div class="alert alert-success" role="alert">
        <?php echo $_GET['msg']; ?>
        product - <?php echo $_GET['name']; ?>
    </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h1><i class="fa-solid fa-list"></i> Hurtownia - products list</h1>
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
                    <th scope="col">Price PLN</th>
                    <th scope="col">Type</th>
                    <th scope="col">Genres/Categories</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            @foreach ($products as $product)
            <tbody>
                <tr class="access_js" id="{{ $product['id'] }}">
                    <td name="id">{{ $product['id']}}</td>
                    <td name="name_">{{ $product['name']}}</td>
                    <td name="short_description">{{ $product['short_description'] ?? 'Brak krotkiego opisu'}}</td>
                    <td name="amount">{{ $product['amount'] }}</td>
                    <td name="price">{{ $product['price'] ?? 99}}</td>
                    <td name="category">{{ $product['type']}}</td>
                    <td name="description" class="d-none">{{ $product['description'] }}</td>
                    <td name="genres">
                        @foreach ($product['genres'] as $key => $genre)
                        {{ $genre }},
                        @endforeach
                    </td>
                    <!-- <td name="genre" data-genres="{{ json_encode($product['genres']) }}"></td> -->
                    <td>

                        <div class="d-flex">
                            <button class="btn btn-primary mr-2">
                                <i class="fa-solid fa-plus fa-1x"></i>
                            </button>

                            <a href="{{ route('hurtownia.show', $product['id']) }}">
                                <button class="btn btn-primary btn-sm ">
                                    <i class="fa-solid fa-magnifying-glass fa-2x"></i>
                                </button>
                            </a>
                        </div>

                    </td>
                </tr>
            </tbody>
            @endforeach

        </table>
    </div>
</div>
<script src="{{ asset('js\hurtownia.js') }}"></script>
@endsection