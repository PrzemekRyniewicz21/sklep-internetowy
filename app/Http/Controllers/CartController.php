<?php

namespace App\Http\Controllers;

use App\Dtos\Cart\CartDto;
use App\Dtos\Cart\CartItemDto;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(Session::get('cart', new CartDto()));
        return view('home');
    }

    public function store(Product $product)
    {
        $cart = Session::get('cart', new CartDto());
        $items = $cart->getItems();
        if(Arr::exists($items, $product->id)){

            $items[$product->id]->increment_quantity();

        } else {
            $cartItemDto = new CartItemDto();
            $cartItemDto->setProductId($product->id);
            $cartItemDto->setName($product->name);
            $cartItemDto->setPrice($product->price);
            $cartItemDto->setImg_path($product->img_path);
            $cartItemDto->increment_quantity();
            $items[$product->id] = $cartItemDto;
        }

        $cart->setItems($items);
        $cart->increment_total_quantity();
        $cart->increment_total_sum($product->price);

        Session::put('cart',$cart); 

        return response()->json([
            'status' => 'success',
        ]); 
    }
}
