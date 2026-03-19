<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Products\Product;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsData = [
            new Product(['name' => 'iPhone 15 Pro', 'description' => 'Latest Apple smartphone with advanced camera', 'brand' => 'Apple', 'category' => 'Electronics', 'unit' => 'pcs', 'price' => 999.99, 'quantity' => 50, 'is_active' => true]),
            new Product(['name' => 'Samsung Galaxy S24', 'description' => 'Flagship Android phone with AI features', 'brand' => 'Samsung', 'category' => 'Electronics', 'unit' => 'pcs', 'price' => 899.99, 'quantity' => 35, 'is_active' => true]),
            new Product(['name' => 'Nike Air Max 90', 'description' => 'Classic tennis sneaker for comfort', 'brand' => 'Nike', 'category' => 'Sports', 'unit' => 'pcs', 'price' => 129.99, 'quantity' => 120, 'is_active' => true]),
            new Product(['name' => 'Sony WH-1000XM5 Headphones', 'description' => 'Premium wireless headphones with noise cancellation', 'brand' => 'Sony', 'category' => 'Electronics', 'unit' => 'pcs', 'price' => 399.99, 'quantity' => 25, 'is_active' => true]),
            new Product(['name' => 'Adidas Ultraboost 22', 'description' => 'High-performance running shoe', 'brand' => 'Adidas', 'category' => 'Sports', 'unit' => 'pcs', 'price' => 180.00, 'quantity' => 80, 'is_active' => true]),
            new Product(['name' => 'Microsoft Surface Laptop 5', 'description' => 'Lightweight laptop for productivity', 'brand' => 'Microsoft', 'category' => 'Electronics', 'unit' => 'pcs', 'price' => 1299.99, 'quantity' => 15, 'is_active' => true]),
            new Product(['name' => 'LG 27 Inch 4K Monitor', 'description' => 'Ultra HD display for professional work', 'brand' => 'LG', 'category' => 'Electronics', 'unit' => 'pcs', 'price' => 449.99, 'quantity' => 30, 'is_active' => true]),
            new Product(['name' => 'Canon EOS R6 Camera', 'description' => 'Professional mirrorless digital camera', 'brand' => 'Canon', 'category' => 'Electronics', 'unit' => 'pcs', 'price' => 2499.99, 'quantity' => 8, 'is_active' => false]),
            new Product(['name' => 'Puma RS-X Sneakers', 'description' => 'Retro-inspired casual shoe', 'brand' => 'Puma', 'category' => 'Sports', 'unit' => 'pcs', 'price' => 89.99, 'quantity' => 100, 'is_active' => true]),
            new Product(['name' => 'Nikon Z9 Camera', 'description' => 'High-end professional imaging device', 'brand' => 'Nikon', 'category' => 'Electronics', 'unit' => 'pcs', 'price' => 5499.99, 'quantity' => 5, 'is_active' => true]),
        ];

        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($productsData, $offset, $perPage);

        $products = new LengthAwarePaginator(
            $items,
            count($productsData),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('pages.products.list.index', compact('products'));
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
