<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product\Product;

class Pricing extends Model
{
    use SoftDeletes;

    protected $table = 'product_pricings';

    public $fillable = [
        'product_id',
        'cost_price',
        'selling_price',
        'is_active'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
