<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Products\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesData = [
            new Category(['name' => 'Electronics', 'description' => 'Electronic devices and gadgets', 'is_active' => true]),
            new Category(['name' => 'Clothing', 'description' => 'Apparel and fashion items', 'is_active' => true]),
            new Category(['name' => 'Books', 'description' => 'Books and literature', 'is_active' => false]),
            new Category(['name' => 'Home & Garden', 'description' => 'Home improvement and gardening supplies', 'is_active' => true]),
            new Category(['name' => 'Sports', 'description' => 'Sports equipment and apparel', 'is_active' => true]),
            new Category(['name' => 'Toys', 'description' => 'Toys and games for children', 'is_active' => false]),
            new Category(['name' => 'Beauty', 'description' => 'Cosmetics and personal care', 'is_active' => true]),
            new Category(['name' => 'Automotive', 'description' => 'Car parts and accessories', 'is_active' => true]),
            new Category(['name' => 'Health', 'description' => 'Health and wellness products', 'is_active' => true]),
            new Category(['name' => 'Food', 'description' => 'Food and beverages', 'is_active' => false]),
        ];

        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($categoriesData, $offset, $perPage);

        $categories = new LengthAwarePaginator(
            $items,
            count($categoriesData),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('pages.products.categories.index', compact('categories'));
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
