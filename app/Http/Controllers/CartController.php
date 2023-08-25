<?php

namespace App\Http\Controllers;

use App\ValueObjects\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Session::get('cart', new Cart())); // jesli nie znajdzie 'cart' zwraca nam nowy Cart()

        return view('cart.index', [
            'cart' => Session::get('cart', new Cart()),
        ]);
    }

    public function store(Product $product)
    {
        $cart = Session::get('cart', new Cart());
         
        Session::put('cart', $cart->addItem($product));

        return response()->json([
            'status' => 'success',
        ]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // dd("???");
        try{
            $cart = Session::get('cart', new Cart());
            Session::put('cart', $cart->removeItem($product));
            Session::flash('status', 'Product deleted!');
            return redirect(route('cart-index'));
            
        } catch (Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error accured!'
            ])->setStatusCode(500);
        }
    }
}

