<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\DateCast;
use App\Models\Shops\PurchaseOrder;
use App\Models\Products\Product;

class PurchaseOrderItem extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_order_items';

    public $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
