<?php

namespace App\Http\Services\Shops;

use App\Http\Services\BaseService;
use App\Http\Repositories\Shops\PurchaseOrderItemRepository;

class PurchaseOrderItemService extends BaseService
{
    public function __construct()
    {
        $this->repository = new PurchaseOrderItemRepository();
    }

    public function all(array $params = [])
    {
        return $this->repository->all($params);
    }

    public function insert(int $purchaseOrderId, array $params = [])
    {
        return $this->repository->insert($purchaseOrderId, $params);
    }

    public function update(int $id, array $params = [])
    {
        return $this->repository->update($id, $params);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
