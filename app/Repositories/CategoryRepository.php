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

    /**
     * Przyjmuje jeden parametr @param string 
     * default'owo jest == '', podanie 'names' sprawi, ze zostana zwrocone tylko cateogry->name
     * @param string $param The input array ''|'names'
     * @return array  
     */
    public function all(string $param = '')
    {
        if ($param == 'names') {

            // przemapowanie categoirs by zawierala tylko nazwy kategori
            $categories = $this->category::all();
            return array_map(fn ($category) => $category->name, $categories->all());
        }
        return $this->category::all();
    }

    public function orderBy($value)
    {
        return $this->category->orderBy($value);
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
