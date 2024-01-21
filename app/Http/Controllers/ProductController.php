<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ShopExcetion as Exception;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(30);

        return response()->view('products.index', [
            'products' => $products
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("??");

        $categories = Categories::all();

        return view('products.create')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        // dane od administrator podane w form /poducts/create
        $data_from_form = $request->validated();

        // collect - po to by uzyc except() aby nie dodawac category_id
        $product = new Product(collect($data_from_form)->except('category_id')->toArray());

        if ($request->hasFile('img')) {
            $product->img_path = $request->file('img')->store('public');
        }

        $product->save();

        // przypisanie odpowiedniej kategori
        $product->categories()->attach($data_from_form['category_id']);

        return redirect(route('products-list'))->with('status', 'product stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Product::find($product->id)->categories()->get()->pluck('name');

        return view("products.show", [
            'product' => $product,
            'categories' => $categories,
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
        $categories = Product::find($product->id)->categories()->get()->pluck('name');

        return view("products.edit", [
            'product' => $product,
            'categories' => $categories,
        ])->with('status', 'Product edited!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated_data = $request; // BRAK WALIDACJI - DO ZROBIENIA !!!

        $product->name = $validated_data['name'];
        $product->short_description = $validated_data['short_description'];
        $product->amount =  $validated_data['amount'];
        $product->price = (float)$validated_data['price']; // decimal

        //edycja kategori - DO ZROBIENIA
        // $categories = $request['categories'];

        $product->save();

        return redirect(route('products-list'))->with('status', 'product stored');
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
        try {
            $product->orders()->detach();
            $product->delete();
            Session::flash('status', 'Product deleted!');
            return redirect(route('products-list'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error accured!'
            ])->setStatusCode(500);
        }
    }

    /**
     * Download image of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function download_img(Product $product)
    {
        if (Storage::exists($product->img_path)) {
            return Storage::download($product->img_path);
        }
        return redirect()->back();
    }
}
