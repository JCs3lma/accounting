<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products\Product;

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

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
