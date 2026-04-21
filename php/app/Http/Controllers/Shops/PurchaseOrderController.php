<?php

namespace App\Http\Controllers\Shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops\Shop;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Shop $shop, Request $request)
    {
        return view('pages.shops.manage.purchase_orders.index', compact('shop'));
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
