<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}