<?php

namespace App\Http\Controllers\Shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops\Shop;
use App\Http\Services\Shops\PurchaseOrderService;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->service = new PurchaseOrderService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Shop $shop, Request $request)
    {
        $params = $request->all();
        $params = array_filter($params, function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        });
        $purchaseOrders = $this->service->all($params);
        return view('pages.shops.manage.purchase_orders.index', compact('shop', 'purchaseOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Shop $shop, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop, string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Shop $shop, Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop, string $id)
    {
        //
    }
}
