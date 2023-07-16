<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        $categories = ProductCategory::orderBy('name')->get();
        
        return view('welcome',[
            'products' => $products,
            'categories' => $categories,
        ]);
    }

}
