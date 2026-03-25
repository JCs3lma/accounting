<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Products\PricingService;
use App\Http\Requests\Products\PricingRequest;

class PricingController extends Controller
{
    public function __construct()
    {
        $this->service = new PricingService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $prices = $this->service->all($params);
        return view('pages.products.prices.index', compact('prices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PricingRequest $request)
    {
        $params = $request->validated();
        $this->service->create($params);
        return redirect()->route('products.pricing.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PricingRequest $request, int $id)
    {
        $params = $request->validated();
        $this->service->update($id, $params);
        return redirect()->route('products.pricing.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('products.pricing.index');
    }
}
