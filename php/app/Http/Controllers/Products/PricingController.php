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
        $params = array_filter($params, function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        });
        $prices = $this->service->all($params);
        $dropdowns = $this->service->dropdowns();
        return view('pages.products.prices.index', compact('prices', 'dropdowns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PricingRequest $request)
    {
        $params = $request->validated();
        $result = $this->service->create($params)->getData(true);
        if (isset($result['error'])) {
            return redirect()->route('products.pricing.index')->withErrors([
                'custom_error' => $result['error']
            ]);
        }

        session()->flash('success', $result['message']);
        return redirect()->route('products.pricing.index', array_filter(request()->query(), function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        }));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PricingRequest $request, int $id)
    {
        $params = $request->validated();
        $result = $this->service->update($id, $params)->getData(true);
        if (isset($result['error'])) {
            return redirect()->route('products.pricing.index')->withErrors([
                'custom_error' => $result['error']
            ]);
        }

        session()->flash('success', $result['message']);
        return redirect()->route('products.pricing.index', array_filter(request()->query(), function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        }));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $result = $this->service->delete($id)->getData(true);
        if (isset($result['error'])) {
            return redirect()->route('products.pricing.index')->withErrors([
                'custom_error' => $result['error']
            ]);
        }

        session()->flash('success', $result['message']);
        return redirect()->route('products.pricing.index', array_filter(request()->query(), function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        }));
    }
}
