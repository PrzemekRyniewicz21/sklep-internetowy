<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class HurtowniaController extends Controller
{
    public function index()
    {

        // dd("??");
        $url = config('hurtownia.url.all_products');
        $apiKey = config('hurtownia.api.key');

        $response  = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url);

        $response = $response['products'];

        // dd($response);
        //
        // foreach ($response[0] as $key => $value) {
        //     dd($key,$value);
        // }

        return view("hurtownia.index", [
            'products' => $response,
            'categories' => Categories::all(),
        ]);
    }

    public function store(Request $request)
    {
        Log::info("---------------");
        Log::info("HurtowniaController - store");

        // tworzymy tablice z gatunkami 
        // explode bierze ',' jako separator i zwraca tablice 
        $genres = explode(",", $request['genres']);

        // trim() - z jakiegos powodu dostaje duzo białych spacji: '      Kategoria  ' 
        $genres = array_map(function ($genre) {
            if (strlen($genre) != 0) {
                return trim($genre);
            }
        }, $genres);

        //usuwam puste stringi 
        $genres = array_filter($genres, fn ($genre) => strlen($genre) > 0);

        // usuwam powtarzajace sie kategorie - z jakiegos powodu API zwraca 1,2,3... x categoria_x dla jednego elementu
        // moze to dodac to osobnej funkcji np. remove_duplicates(array) = ZROBIONE
        $genres = $this->remove_duplicates($genres);

        // pobieramy gatunki i sprawdzmy czy istnieje jakis, ktorego jescze nie mamy w bazie danyc
        // jesli taki znajdziemy, aktualizujemy baze danych
        $categories = Categories::all();

        // $categories->all() dlatego, ze ::all() zwraca kolekcje, a nie tablice
        // ->all() zwraca surową tablice
        $categories = array_map(fn ($category) => $category->name, $categories->all());

        // roznica = kategoire ktorych nie mamy obecnie w bazie danych = kategorie do dodania
        $categories_to_add = $this->remove_duplicates($genres, $categories);

        Log::info("Przychodzace: ");
        Log::info($genres);
        Log::info("Obecne: ");
        Log::info($categories);
        Log::info("Do dodawnia: ");
        Log::info($categories_to_add);

        // dd();

        DB::transaction(function () use ($categories_to_add, $request, $genres) {

            // Transakcja dla kategorii
            foreach ($categories_to_add as $c) {
                try {
                    $trimmedName = trim($c);
                    if (!empty($trimmedName)) {
                        Categories::create(['name' => $trimmedName]);
                    }
                } catch (\Exception $e) {
                    Log::error('Błąd podczas dodawania kategorii: ' . $e->getMessage());
                }
            }

            // Transakcja dla produktu
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'string',
                'short_description' => 'string',
                'amount' => 'required|string|min:0',
                'price' => 'required|min:0',
            ]);

            try {
                $product = Product::create($request->only(['name', 'description', 'short_description', 'amount', 'price']));
            } catch (QueryException $e) {
                Log::error('Bład podczas tworzenia produtu: ' . $e->getMessage());
            }

            // pobieranie id kategori, ktore chcemy przypisac do danego produktu
            // genres to kategorie przychodace od ajax (kategorie produktu, ktory chcemy dodac)

            $ids = [];
            foreach ($genres as $name) {
                $ids[] = Categories::getCategoryId($name);
            }

            Log::channel('debug')->info($ids[1]);
            $product->categories()->attach($ids);
        }, 5);

        // Gdy juz sfinalizujemy kwestie dodawnia produktu do sklepu, wysyalmy o tym informacje do hurtowni
        // Hurtownia aktualizuje ilosc (amount--)
        $url = config('hurtownia.url.update') . $request['id'];
        Log::channel('debug')->info($url);
        Http::put($url);
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

    /**
     * remove_duplicates()
     * Jesli podamy tylko jedna tablive arrayB, zostaje zwrocona bez powtorzen
     * Jesli podamy dwa argumrnty arrayA i arrayB, zwrocona zostaje tablica arrayA - arrayB
     * 
     * @param array $arrayA The input array
     * @param array|null $arrayB Another array (optional)
     * @return array Array without duplicated values
     */

    private function remove_duplicates(array $array, array $array2 = null)
    {

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
}
