<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\DateCast;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_orders';

    public $fillable = [
        'po_number',
        'supplier_id',
        'order_date',
        'expected_date',
        'status',
        'subtotal',
        'tax',
        'total',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'order_date' => DateCast::class,
        'expected_date' => DateCast::class,
    ];
}
