<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\DateCast;
use App\Models\Shops\PurchaseOrderItem;
use App\Models\Suppliers\Supplier;

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

    public function orders()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
