@extends('layouts.app')

@section('css-files')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

    <div class="cart_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart<small> {{ $cart->getItems()->count() }}</small></div>
                        <!-- <form action="{{ route('order.store') }}" method="POST" id="order-form"> -->

                            <!-- @csrf -->

                            <div class="cart_items">
                                <ul class="cart_list">
                                    @foreach($cart->getItems() as $item)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img src="{{ $item->getImg() }}" alt=""></div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $item->getName() }}</div>
                                            </div>
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <div class="cart_item_text">{{ $item->getQuantity() }}</div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">{{ $item->getPrice() }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">{{ $item->getSum() }}</div>
                                            </div>
                                            <div class="cart_info_col">
                                                <form style="float:right" action="{{ route('cart-delete', $item->getProductId()) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten produkt?')" id="inside-form">
                                                    @method('DELETE')
                                                    <!-- @csrf -->
                                                    <button type="submit" class="btn btn-danger btn-sm delete">
                                                        <i class="fa-solid fa-trash">??</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="order_total">
                                <div class="order_total_content text-md-right">
                                    <div class="order_total_title">Order Total:</div>
                                    <div class="order_total_amount">{{ $cart->getSum() }}</div>
                                </div>
                            </div>
                            <div class="cart_buttons"> 
                                <a href="/" class="button cart_button_clear">Continue Shopping</a> 
                                <form action="{{route('order.store')}}" method="POST" id="store-form">
                                    @csrf
                                    <button type="submit" class="button cart_button_checkout">Pay</button> 
                                </form>
                            </div>
                        <!-- </form> -->

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


