<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // Optional: prevent Laravel from expecting a table
    public $timestamps = false;
    protected $table = null;

    public $fillable = ['name', 'contact_person', 'email', 'phone', 'address', 'is_active'];
}
