<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request)
    {
        $filters = $request->query('filter');
        $paginate = $request->query('paginate') ?? 5;
        $query = Product::query();
        $query->paginate($paginate);
        
        // dd($filters['price_min']);

        if(!is_null($filters)){

            if(array_key_exists('categories', $filters)){
                $query = $query->whereIn('category_id', $filters['categories']);
            }

            if(!is_null($filters['price_min'])){
                $query = $query->where('price', '>=', $filters['price_min']);
            }

            if(!is_null($filters['price_max'])){
                $query = $query->where('price', '<=', $filters['price_max']);
            }

            return response()->json([
                'data' => $query->get(),
            ]);
        }
        
        $products = $query->get();
        $categories = ProductCategory::orderBy('name')->get();
        
        return view('welcome',[
            'products' => $products,
            'categories' => $categories,
            'default_img' => 'https://via.placeholder.com/240x240/5fa9f8/efefef'
        ]);
    }

}
