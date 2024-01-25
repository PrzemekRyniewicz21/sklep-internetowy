<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class ProductRepository
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product->all();
    }

    public function find($id): ?Product
    {
        return $this->product->find($id);
    }

    public function paginate($value): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->product->paginate($value);
    }

    public function createProduct($formData)
    {
        $formData->only(['name', 'description', 'short_description', 'amount', 'price']);

        if (($this->validate_product($formData)) == null) {

            $productData = collect($formData)->except('category_id')->toArray();
            $product = new $this->product($productData);
        }

        foreach ($this->validate_product($formData) as $error) {
            echo $error;
        }

        $productData = collect($formData)->except('category_id')->toArray();
        $product = new $this->product->create($productData);


        return $product;
    }

    public function saveProduct(Product $product)
    {
        return $product->save();
    }

    public function attachCategoriesToProduct(Product $product, $ids_of_categories_to_attach): void
    {
        $product->categories()->attach($ids_of_categories_to_attach);
    }

    // public function attach_category(Product $product, $categoryId): void
    // {
    //     $product->categories()->attach($categoryId);
    // }

    private function validate_product($formData)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'string',
            'short_description' => 'string',
            'amount' => 'required|string|min:0',
            'price' => 'required|min:0',
        ];

        $errors = [];

        foreach ($rules as $field => $rule) {
            // Sprawdzanie, czy pole istnieje w danych
            if (!isset($formData[$field])) {
                $errors[] = "$field is missing";
                continue;
            }

            // Sprawdź zgodność z regułą walidacji
            if ($rule === 'required' && empty($formData[$field])) {
                $errors[] = "$field is required";
            } elseif ($rule === 'string' && !is_string($formData[$field])) {
                $errors[] = "$field must be a string";
            } elseif ($rule === 'max:255' && strlen($formData[$field]) > 255) {
                $errors[] = "$field must be at most 255 characters long";
            } elseif ($rule === 'min:0' && $formData[$field] < 0) {
                $errors[] = "$field must be at least 0";
            }

            //kolejne warunki jesli jakies dojda...
        }

        return $errors;
    }
}
