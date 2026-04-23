<?php

namespace App\Http\Controllers\Shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops\Shop;
use App\Http\Requests\Shops\PurchaseOrderRequest;
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
        $dropdowns = $this->service->dropdowns();
        return view('pages.shops.manage.purchase_orders.index', compact('shop', 'purchaseOrders', 'dropdowns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Shop $shop, PurchaseOrderRequest $request)
    {
        $params = $request->validated();
        $result = $this->service->create($params)->getData(true);
        if (isset($result['error'])) {
            return redirect()->route('shops.index')->withErrors([
                'custom_error' => $result['error']
            ]);
        }

        session()->flash('success', $result['message']);
        return redirect()->route('shops.index', array_filter(request()->query(), function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        }));
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
