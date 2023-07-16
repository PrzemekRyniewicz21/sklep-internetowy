<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = []; // mass assignment exception :/ 

    protected $fillable = [
        'name',
        'img_path',
        'description',
        'amount',
        'price',
        'category_id',

    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function isSelectedCategory(int $category_id): bool {
        return $this->hasCategory() && ($this->category->id == $category_id);
    }

    public function hasCategory(): bool {
        return !is_null($this->category);
    }
}