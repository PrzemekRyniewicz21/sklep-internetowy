<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Categories;
use Illuminate\Support\Facades\Log;

class CategoryRepository
{
    private Categories $category;

    public function __construct(Categories $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return $this->category::all();
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function createCategory(array $categories_to_add)
    {
        foreach ($categories_to_add as $c) {
            try {
                $trimmedName = trim($c);
                if (!empty($trimmedName)) {
                    $this->category->create(['name' => $trimmedName]);
                }
            } catch (\Exception $e) {
                Log::error('Błąd podczas dodawania kategorii: ' . $e->getMessage());
            }
        }
    }

    public function getCategoryIdsByNames($genres)
    {
        $ids = [];
        foreach ($genres as $name) {
            $ids[] = Categories::getCategoryId($name);
        }
        return $ids;
    }
}
