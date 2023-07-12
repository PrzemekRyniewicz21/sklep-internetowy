<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        
        return view('products.index',[
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("??");
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        // phpinfo();
        // dd($request->file('img')->store('pulic'));



        $product = new Product($request->validated());

        if($request->hasFile('img')){
            $product->img_path = $request->file('img')->store('public');
        }

        $product->save();

        return redirect(route('products-list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view("products.show",[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd($product);

        return view("products.edit",[
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        
        if($request->hasFile('img')){
            $product->img_path = $request->file('img')->store('public');
        }

        $product->save();
        // dd("???");
        return redirect(route('products-list'));
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
            $product->delete();

            return redirect(route('products-list'));
            
        } catch (Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error accured!'
            ])->setStatusCode(500);
        }
    }
}
