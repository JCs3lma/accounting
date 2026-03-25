<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Unit;

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
