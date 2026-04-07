<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\ImageCast;

class Brand extends Model
{
    use SoftDeletes;

    protected $table = 'brands';

    public $fillable = [
        'name',
        'description',
        'logo_path',
        'is_active'
    ];

    protected $casts = [
        'logo_path' => ImageCast::class,
        'is_active' => 'boolean',
    ];
}
