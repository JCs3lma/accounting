<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // Optional: prevent Laravel from expecting a table
    public $timestamps = false;
    protected $table = null;

    public $fillable = ['name', 'abbreviation', 'description', 'is_active'];
}
