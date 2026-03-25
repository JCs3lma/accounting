<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'suppliers';

    public $fillable = [
        'name',
        'contact_person',
        'logo_path',
        'email',
        'phone',
        'mobile',
        'address',
        'is_active',
    ];
}
