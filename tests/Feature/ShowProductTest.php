<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowProduct()
    {
        // Tworzenie przykładowego produktu o id = 13
        $product = Product::factory()->create();

        // Wywołanie metody show na konkretnym produkcie
        $response = $this->get(route('products-show', ['product' => $product->id]));

        // Sprawdzenie, czy odpowiedź zawiera oczekiwane dane produktu
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->description);
        // Dodaj więcej asercji, jeśli istnieją inne pola, które chcesz sprawdzić
    }
}
