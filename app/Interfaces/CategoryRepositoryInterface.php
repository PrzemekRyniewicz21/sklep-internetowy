<?php

namespace App\Interfaces;

use App\Models\Categories;

interface CategoryRepositoryInterface
{
    /**
     * Get all categories.
     *
     * @param string $param
     * @return mixed
     */
    public function all(string $param = '');

    /**
     * Order categories by the given value.
     *
     * @param string $value
     * @return mixed
     */
    public function orderBy($value);

    /**
     * Find a category by ID.
     *
     * @param int $id
     * @return Categories
     */
    public function find($id);

    /**
     * Create categories based on the provided array.
     *
     * @param array $categoriesToAdd
     * @return void
     */
    public function createCategory(array $categoriesToAdd);

    /**
     * Get category IDs by names.
     *
     * @param array $genres
     * @return array
     */
    public function getCategoryIdsByNames($genres);
}
