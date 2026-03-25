<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Products\CategoryRequest;
use App\Http\Services\Products\CategoryService;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->service = new CategoryService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $categories = $this->service->all($params);
        return view('pages.products.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->validated();
        $this->service->create($params);
        return redirect()->route('products.categories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        $params = $request->validated();
        $this->service->update($id, $params);
        return redirect()->route('products.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('products.categories.index');
    }
}
