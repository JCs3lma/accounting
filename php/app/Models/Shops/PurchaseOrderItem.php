<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\DateCast;

class PurchaseOrderItem extends Model
{
    use SoftDeletes;

    protected $table = 'shops';

    public $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'received_quantity',
        'price',
        'total',
    ];
}
