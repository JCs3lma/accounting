<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Optional: prevent Laravel from expecting a table
    public $timestamps = false;
    protected $table = null;

    public $fillable = ['name', 'description', 'logo', 'website', 'is_active'];
}
