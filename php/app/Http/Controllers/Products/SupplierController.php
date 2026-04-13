<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Products\SupplierService;
use App\Http\Requests\Products\SupplierRequest;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->service = new SupplierService();
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
        $suppliers = $this->service->all($params);
        return view('pages.products.suppliers.index', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $params = $request->validated();
        $result = $this->service->create($params)->getData(true);
        if (isset($result['error'])) {
            return redirect()->route('products.suppliers.index')->withErrors([
                'custom_error' => $result['error']
            ]);
        }

        session()->flash('success', $result['message']);
        return redirect()->route('products.suppliers.index', array_filter(request()->query(), function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        }));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, int $id)
    {
        $params = $request->validated();
        $result = $this->service->update($id, $params)->getData(true);
        if (isset($result['error'])) {
            return redirect()->route('products.suppliers.index')->withErrors([
                'custom_error' => $result['error']
            ]);
        }

        session()->flash('success', $result['message']);
        return redirect()->route('products.suppliers.index', array_filter(request()->query(), function($value) {
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
            return redirect()->route('products.suppliers.index')->withErrors([
                'custom_error' => $result['error']
            ]);
        }

        session()->flash('success', $result['message']);
        return redirect()->route('products.suppliers.index', array_filter(request()->query(), function($value) {
            return $value !== null && $value !== '' && $value !== 'null';
        }));
    }
}
