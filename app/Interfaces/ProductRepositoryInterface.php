<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function all(): \Illuminate\Database\Eloquent\Collection;

    public function find($id): ?Product;

    public function paginate($value): \Illuminate\Pagination\LengthAwarePaginator;

    public function query();

    public function createProduct($formData);

    public function updateProduct(Product $product, array $validatedData);

    public function saveProduct(Product $product);

    public function attachCategoriesToProduct(Product $product, $ids_of_categories_to_attach): void;
}
