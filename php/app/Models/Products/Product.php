<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Unit;
use App\Casts\ImageCast;
use App\Casts\BarcodeCast;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    public $fillable = [
        'name',
        'description',
        'logo_path',
        'brand_id',
        'category_id',
        'unit_id',
        'barcode',
        'serial_number',
        'sku',
        'is_active',
    ];

    protected $casts = [
        'logo_path' => ImageCast::class,
        'is_active' => 'boolean',
        'barcode' => BarcodeCast::class,
    ];

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
