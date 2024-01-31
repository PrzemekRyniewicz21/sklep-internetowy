<?php

namespace App\Repositories;

use App\Interfaces\HurtowniaRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HurtowniaRepository implements HurtowniaRepositoryInterface
{
    public function getAllProducts()
    {
        $url = config('hurtownia.url.all_products');
        $apiKey = config('hurtownia.api.key');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url);

        return $response['products'];
    }

    public function UpdateProductAmountInHurtownia($productId)
    {
        $url = config('hurtownia.url.update') . $productId;
        Log::channel('debug')->info($url);
        Http::put($url);
    }
}
