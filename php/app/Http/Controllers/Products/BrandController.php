<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Products\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandsData = [
            new Brand(['name' => 'Apple', 'description' => 'Technology company known for iPhones and Macs', 'logo' => 'https://cdn.pixabay.com/photo/2022/09/11/06/01/apple-7446229_1280.png', 'is_active' => true]),
            new Brand(['name' => 'Samsung', 'description' => 'Electronics manufacturer for phones, TVs, and appliances', 'logo' => 'https://static.vecteezy.com/system/resources/previews/020/975/545/non_2x/samsung-logo-samsung-icon-transparent-free-png.png', 'is_active' => true]),
            new Brand(['name' => 'Nike', 'description' => 'Sports apparel and footwear brand', 'logo' => 'https://static.vecteezy.com/system/resources/thumbnails/010/994/232/small/nike-logo-black-clothes-design-icon-abstract-football-illustration-with-white-background-free-vector.jpg', 'is_active' => true]),
            new Brand(['name' => 'Sony', 'description' => 'Consumer electronics and entertainment company', 'logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROj8_qhqEdQMXjfO8UW9HgEbYeFrjvV0IclQ&s', 'is_active' => true]),
            new Brand(['name' => 'Adidas', 'description' => 'Athletic shoes and apparel brand', 'logo' => 'https://static.vecteezy.com/system/resources/thumbnails/014/414/689/small/adidas-new-logo-on-transparent-background-free-vector.jpg', 'is_active' => true]),
            new Brand(['name' => 'Microsoft', 'description' => 'Software and technology company', 'logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnt253Qlda-6a5x8LltLHZD4IWMCmk7LOQ9Q&s', 'is_active' => true]),
            new Brand(['name' => 'LG', 'description' => 'Electronics manufacturer specializing in displays', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/LG_logo_%282014%29.svg/960px-LG_logo_%282014%29.svg.png', 'is_active' => true]),
            new Brand(['name' => 'Puma', 'description' => 'Sports and athletic brand', 'logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTerm-W6EkfV1T9WN7XRR53HXNkVWGQY-4miQ&s', 'is_active' => false]),
            new Brand(['name' => 'Canon', 'description' => 'Imaging products manufacturer', 'logo' => 'https://global.canon/en/corporate/logo/img/logo_01.png', 'is_active' => true]),
            new Brand(['name' => 'Nikon', 'description' => 'Photography and imaging equipment brand', 'logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvGX30TwxGLXSHh-RjCNXQLzvP4R4M6tvFSw&s', 'is_active' => true]),
        ];

        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($brandsData, $offset, $perPage);

        $brands = new LengthAwarePaginator(
            $items,
            count($brandsData),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('pages.products.brands.index', compact('brands'));
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
