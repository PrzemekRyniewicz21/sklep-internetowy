<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Product extends Model
{
    use HasFactory; // od czego to jest ?

    protected $guarded = []; // mass assignment exception :/ 

    protected $fillable = [
        'name',
        'img_path',
        'description',
        'amount',
        'price',
        'category_id',

    ];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_category', 'product_id', 'category_id');
    }

    public function isSelectedCategory(int $category_id): bool
    {
        return $this->hasCategory() && ($this->category->id == $category_id);
    }

    public function hasCategory(): bool
    {
        return !is_null($this->category);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
