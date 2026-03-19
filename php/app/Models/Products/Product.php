<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Optional: prevent Laravel from expecting a table
    public $timestamps = false;
    protected $table = null;

    public $fillable = ['name', 'description', 'brand', 'category', 'unit', 'price', 'quantity', 'is_active'];
}
