<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Optional: prevent Laravel from expecting a table
    public $timestamps = false;
    protected $table = null;

    public $fillable = ['name', 'description', 'is_active'];
}
