<?php

namespace App\Http\Services\Shops;

use App\Http\Services\BaseService;
use App\Http\Repositories\Shops\PurchaseOrderRepository;
use App\Http\Services\Shops\PurchaseOrderItemService;

class PurchaseOrderService extends BaseService
{
    public function __construct()
    {
        $this->repository = new PurchaseOrderRepository();
        $this->service = new PurchaseOrderItemService();
    }

    public function all(array $params = [])
    {
        return $this->repository->all($params);
    }

    public function create(array $params = [])
    {
        $purchaseOrderParams = [
            'supplier_id' => $params['supplier_id'] ?? null,
            'order_date' => $params['order_date'] ?? null,
            'expected_date' => $params['expected_date'] ?? null,
            'status' => $params['status'] ?? null,
            'subtotal' => $params['subtotal'] ?? null,
            'tax' => $params['tax'] ?? null,
            'total' => $params['total'] ?? null,
            'notes' => $params['notes'] ?? null,
            'created_by' => $params['created_by'] ?? null,
        ];

        $purchaseOrder = $this->repository->create($purchaseOrderParams)->getData(true);
        if (isset($purchaseOrder['error'])) {
            return $this->repository->error('Failed to create purchase order', [], $this->repository->internalServerError);
        }
        $purchaseOrderId = $purchaseOrder['data']['id'];

        $purchaseOrderItemsParams = array_map(function ($value) use($purchaseOrderId) {
            return [
                'purchase_order_id' => $purchaseOrderId,
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'price' => $value['price'],
                'total' => $value['quantity'] * $value['price'],
            ];
        }, $params['products']);
        
        $purchaseOrderItems = $this->service->insert($purchaseOrderId, $purchaseOrderItemsParams)->getData(true);
        if (isset($purchaseOrderItems['error'])) {
            return $this->repository->error('Failed to add purchase order items', [], $this->repository->internalServerError);
        }

        return $this->repository->success($purchaseOrder['data'], $purchaseOrder['message']);
    }

    public function update(int $id, array $params = [])
    {
        return $this->repository->update($id, $params)->getData(true);
    }

    public function delete(int $id)
    {
        $purchaseOrder = $this->repository->delete($id)->getData(true);
        // TODO:: add PurchaseOrder Item
        return $this->repository->success();
    }

    public function dropdown()
    {
        return $this->repository->dropdown();
    }
}
