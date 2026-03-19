<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Products\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliersData = [
            new Supplier(['name' => 'Global Electronics Supply', 'contact_person' => 'John Smith', 'email' => 'john@globalelex.com', 'phone' => '+1-555-0101', 'address' => '123 Industrial Ave, New York', 'is_active' => true]),
            new Supplier(['name' => 'Premier Textile Co.', 'contact_person' => 'Sarah Johnson', 'email' => 'sarah@premtextile.com', 'phone' => '+1-555-0102', 'address' => '456 Fashion Blvd, Los Angeles', 'is_active' => true]),
            new Supplier(['name' => 'Tech Components Ltd', 'contact_person' => 'Michael Chen', 'email' => 'michael@techcomp.com', 'phone' => '+1-555-0103', 'address' => '789 Tech Park, San Francisco', 'is_active' => true]),
            new Supplier(['name' => 'Quality Materials Inc', 'contact_person' => 'Emma Wilson', 'email' => 'emma@qmaterials.com', 'phone' => '+1-555-0104', 'address' => '321 Commerce St, Chicago', 'is_active' => true]),
            new Supplier(['name' => 'Eco Packaging Solutions', 'contact_person' => 'David Green', 'email' => 'david@ecopacking.com', 'phone' => '+1-555-0105', 'address' => '654 Green Way, Boston', 'is_active' => true]),
            new Supplier(['name' => 'Global Imports Corp', 'contact_person' => 'Lisa Anderson', 'email' => 'lisa@globalimports.com', 'phone' => '+1-555-0106', 'address' => '987 Trade Center, Miami', 'is_active' => true]),
            new Supplier(['name' => 'Advanced Logistics', 'contact_person' => 'Robert Martinez', 'email' => 'robert@advlogistics.com', 'phone' => '+1-555-0107', 'address' => '147 Logistics Way, Houston', 'is_active' => true]),
            new Supplier(['name' => 'Premium Goods Trading', 'contact_person' => 'Jennifer Lee', 'email' => 'jennifer@premgoods.com', 'phone' => '+1-555-0108', 'address' => '258 Trade St, Seattle', 'is_active' => false]),
            new Supplier(['name' => 'Standard Parts Wholesale', 'contact_person' => 'James Brown', 'email' => 'james@stdparts.com', 'phone' => '+1-555-0109', 'address' => '369 Wholesale Blvd, Denver', 'is_active' => true]),
            new Supplier(['name' => 'Direct Import Services', 'contact_person' => 'Maria Garcia', 'email' => 'maria@directimport.com', 'phone' => '+1-555-0110', 'address' => '741 Port St, Atlanta', 'is_active' => true]),
        ];

        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($suppliersData, $offset, $perPage);

        $suppliers = new LengthAwarePaginator(
            $items,
            count($suppliersData),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('pages.products.suppliers.index', compact('suppliers'));
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
