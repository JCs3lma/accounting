<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\ImageCast;

class Shop extends Model
{
    use SoftDeletes;

    protected $table = 'shops';

    public $fillable = [
        'shop_name',
        'contact_person',
        'logo_path',
        'email',
        'phone',
        'mobile',
        'address',
        'is_active',
    ];

    protected $casts = [
        'logo_path' => ImageCast::class,
        'is_active' => 'boolean',
    ];
}
