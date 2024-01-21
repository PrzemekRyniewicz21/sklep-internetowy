<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Categories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('welcome.index'));

        // Sprawdź, czy odpowiedź ma kod 200
        $response->assertStatus(200);

        // Sprawdź, czy przekierowanie odbywa się na właściwą stronę paginacji
        // $response->assertViewIs('products.index');
    }
}
