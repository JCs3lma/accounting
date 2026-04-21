<?php

namespace App\Http\Services\Suppliers;

use App\Http\Services\BaseService;
use App\Http\Services\Products\BrandService;
use App\Http\Services\Products\CategoryService;
use App\Http\Services\Products\ProductService;
use App\Http\Repositories\Suppliers\PricingRepository;

class PricingService extends BaseService
{
    public function __construct()
    {
        $this->repository = new PricingRepository();
        $this->services = [
            'brand' => new BrandService(),
            'category' => new CategoryService(),
            'product' => new ProductService(),
        ];
    }

    public function all(array $params = [])
    {
        return $this->repository->all($params);
    }

    public function create(array $params = [])
    {
        return $this->repository->create($params);
    }

    public function update(int $id, array $params = [])
    {
        return $this->repository->update($id, $params);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function dropdowns()
    {
        return [
            'brands' => $this->services['brand']->dropdown(false, true, false),
            'categories' => $this->services['category']->dropdown(false, true, false),
            'products' => $this->services['product']->dropdown(false, true, false),
        ];
    }
}
