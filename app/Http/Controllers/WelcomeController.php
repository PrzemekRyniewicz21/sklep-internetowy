<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

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
        $sort = $request->query('sort') ?? 'desc';
        $query = Product::query();

        if(!is_null($filters)){

            Log::info($request);

            if(array_key_exists('categories', $filters)){
                $query = $query->whereIn('category_id', $filters['categories']);
            }

            if(!is_null($filters['price_min'])){
                $query = $query->where('price', '>=', $filters['price_min']);
            }

            if(!is_null($filters['price_max'])){
                $query = $query->where('price', '<=', $filters['price_max']);
            }

            $query = $query->orderBy('price', $sort);

            return response()->json($query->paginate($paginate));
        }
        
        $categories = ProductCategory::orderBy('name')->get();
        
        return view('welcome',[
            'products' => $query->paginate($paginate),
            'categories' => $categories,
            'default_img' => config('shop.default_img'),
            'isGuest' => Auth::guest(),
        ]);
    }

}
