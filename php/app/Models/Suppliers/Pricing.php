<?php

namespace App\Models\Suppliers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products\Product;
use App\Models\Suppliers\Supplier;

class Pricing extends Model
{
    use SoftDeletes;

    protected $table = 'product_pricings';

    public $fillable = [
        'product_id',
        'supplier_id',
        'price',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
