<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ProductCategory;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;

class HurtowniaController extends Controller
{
    public function index()
    {

        // dd("??");
        $url = 'hurtownia/api/products';

        $apiKey = 'zaq1@WSX';


        $response  = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url);

        $response = $response['products'];
        //
        // foreach ($response[0] as $key => $value) {
        //     dd($key,$value);
        // }

        return view("hurtownia.index", [
            'products' => $response,
            'categories' => ProductCategory::all(),
        ]);
    }

    public function store2(Request $request)
    {
        // Log::info(Product::find(13));
        // $product = Product::find(22);
        // $product->delete();
        // $product1->name = "test";
        //dodawanie nowego produktu z hurtowni
        // dd($request['description']);
        $produkt = new Product();
        $produkt->name = $request['name'];
        $produkt->description = $request['description'];
        $produkt->amount = $request['amount'];
        $produkt->price = 2.0;
        // $produkt->category = $request['category'];

        $produkt->save();
    }
}
