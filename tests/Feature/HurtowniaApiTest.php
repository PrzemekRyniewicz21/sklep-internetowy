<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Categories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class HurtowniaApiTest extends TestCase
{
    // use RefreshDatabase;

    public function testIndex()
    {
        $url = config('hurtownia.url.all_products');
        $api_key = config('hurtownia.api.key');
        Log::channel('debug')->info($url);
        $response = Http::withHeaders([
            'Authorization' => $api_key,
        ])->get($url);

        // Sprawdź, czy żądanie zakończyło się sukcesem (status 2xx)
        $this->assertTrue($response->successful());

        // Sprawdź, czy kod statusu to 200
        $this->assertEquals(200, $response->status());
    }
}
