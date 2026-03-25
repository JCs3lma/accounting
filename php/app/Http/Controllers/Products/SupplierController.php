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
        $suppliers = $this->service->all($params);
        return view('pages.products.suppliers.index', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $params = $request->validated();
        $this->service->create($params);
        return redirect()->route('products.suppliers.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, int $id)
    {
        $params = $request->validated();
        $this->service->update($id, $params);
        return redirect()->route('products.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('products.suppliers.index');
    }
}
