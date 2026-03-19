<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Products\Unit;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitsData = [
            new Unit(['name' => 'Kilogram', 'abbreviation' => 'kg', 'description' => 'Unit of mass/weight', 'is_active' => true]),
            new Unit(['name' => 'Gram', 'abbreviation' => 'g', 'description' => 'Unit of mass', 'is_active' => true]),
            new Unit(['name' => 'Liter', 'abbreviation' => 'L', 'description' => 'Unit of volume', 'is_active' => true]),
            new Unit(['name' => 'Milliliter', 'abbreviation' => 'ml', 'description' => 'Unit of volume', 'is_active' => true]),
            new Unit(['name' => 'Meter', 'abbreviation' => 'm', 'description' => 'Unit of length', 'is_active' => true]),
            new Unit(['name' => 'Centimeter', 'abbreviation' => 'cm', 'description' => 'Unit of length', 'is_active' => true]),
            new Unit(['name' => 'Piece', 'abbreviation' => 'pcs', 'description' => 'Individual items', 'is_active' => true]),
            new Unit(['name' => 'Box', 'abbreviation' => 'box', 'description' => 'Box containing items', 'is_active' => true]),
            new Unit(['name' => 'Dozen', 'abbreviation' => 'dz', 'description' => 'Set of twelve items', 'is_active' => true]),
            new Unit(['name' => 'Pack', 'abbreviation' => 'pk', 'description' => 'Package of items', 'is_active' => false]),
        ];

        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($unitsData, $offset, $perPage);

        $units = new LengthAwarePaginator(
            $items,
            count($unitsData),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('pages.products.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
