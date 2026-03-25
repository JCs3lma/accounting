<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Products\UnitService;
use App\Http\Requests\Products\UnitRequest;

class UnitsController extends Controller
{
    public function __construct()
    {
        $this->service = new UnitService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $units = $this->service->all($params);
        return view('pages.products.units.index', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        $params = $request->validated();
        $this->service->create($params);
        return redirect()->route('products.units.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, int $id)
    {
        $params = $request->validated();
        $this->service->update($id, $params);
        return redirect()->route('products.units.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('products.units.index');
    }
}
