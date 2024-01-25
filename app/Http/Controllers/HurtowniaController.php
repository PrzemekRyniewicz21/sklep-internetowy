<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Repositories\HurtowniaRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;

class HurtowniaController extends Controller
{
    protected $hurtowniaRepository;
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        HurtowniaRepository $hurtowniaRepository,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->hurtowniaRepository = $hurtowniaRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        Log::channel('debug')->info("hurtowniaC index");
        $response = $this->hurtowniaRepository->getAllProducts();

        return view("hurtownia.index", [
            'products' => $response,
            'categories' => $this->categoryRepository->all(),
        ]);
    }

    public function store(Request $request)
    {
        dd("????");
        Log::info("---------------");
        Log::info("HurtowniaController - store");

        $genres = $this->parseGenres($request['genres']);

        $genres = $this->remove_duplicates($genres);

        $categories = $this->categoryRepository->all();
        $categoriesToAdd = $this->removeDuplicates($genres, $categories);

        Log::info("Przychodzace: ");
        Log::info($genres);
        Log::info("Obecne: ");
        Log::info($categories);
        Log::info("Do dodawnia: ");
        Log::info($categoriesToAdd);

        DB::transaction(function () use ($categoriesToAdd, $request, $genres) {
            $this->updateCategories($categoriesToAdd);
            $product = $this->validateAndCreateProduct($request);
            $this->attachProductCategories($product, $genres);
        }, 5);

        // $this->hurtowniaRepository->updateProductInWarehouse($request['id']);
    }

    public function show(Request $request)
    {
        $url = config('hurtownia.url.description');
        $apiKey = config('hurtownia.api.key');

        $response  = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url, ['id' => $request->id]);

        // dd($response['description']);

        return view('hurtownia.show')->with([
            'description' => $response['description'] ?? 'No description',
        ]);
    }

    // Pozostałe metody zostały przeniesione do odpowiednich repozytoriów
    // ...

    private function parseGenres($genres)
    {
        //usuwam puste stringi 
        return array_filter($genres, fn ($genre) => strlen($genre) > 0);
    }

    private function remove_duplicates(array $array, array $array2 = null)
    {
        //usuwam powtarzajace sie kategorie - z jakiegos powodu API zwraca 1,2,3... x categoria_x dla jednego elementu

        $result = [];

        if ($array2 != null) {

            foreach ($array as $value) {
                if (!in_array($value, $array2)) {
                    $result[] = $value;
                }
            }
        } else {

            foreach ($array as $value) {
                if (!in_array($value, $result)) {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }


    private function updateCategories(array $categoriesToAdd)
    {
        $this->categoryRepository->createCategory($categoriesToAdd);
    }

    private function validateAndCreateProduct(Request $request)
    {
        return $this->productRepository->createProduct($request->only(['name', 'description', 'short_description', 'amount', 'price']));
    }

    private function attachProductCategories($product, $genres)
    {
        $categoryIds = $this->categoryRepository->getCategoryIdsByNames($genres);
        $this->productRepository->attachCategoriesToProduct($product, $categoryIds);
    }
}
