<?php

namespace App\Http\Services\Shops;

use App\Http\Services\BaseService;
use App\Http\Services\Shops\ShopStaffService;
use App\Http\Repositories\Shops\StaffRepository;

class StaffService extends BaseService
{
    public function __construct()
    {
        $this->repository = new StaffRepository();
        $this->service = new ShopStaffService();
    }

    public function all(array $params = [], int $shopId)
    {
        return $this->repository->all($params, $shopId);
    }

    public function create(array $params = [])
    {
        $staffParams = [
            'first_name' => $params['first_name'],
            'middle_name' => $params['middle_name'] ?? null,
            'last_name' => $params['last_name'] ?? null,
            'profile_path' => $params['profile_path'] ?? null,
            'email' => $params['email'] ?? null,
            'phone' => $params['phone'] ?? null,
            'mobile' => $params['mobile'] ?? null,
            'address' => $params['address'] ?? null,
            'profile_path_remove' => $params['profile_path_remove'] ?? null,
            'is_active' => $params['is_active'] ?? null,
        ];
        $staffResult = $this->repository->create($staffParams)->getData(true);
        if (isset($staffResult['error'])) {
            return $this->repository->error('Failed to create staff', [], $this->repository->internalServerError);
        }
        $shopStaffParams = [
            'shop_ids' => $params['shop_ids'],
            'staff_id' => $staffResult['data']['id'],
            'employment_status' => $params['employment_status'],
            'hire_date' => $params['hire_date'],
        ];
        return $this->service->create($shopStaffParams);
    }

    public function update(int $id, array $params = [])
    {
        $staffParams = [
            'first_name' => $params['first_name'],
            'middle_name' => $params['middle_name'] ?? null,
            'last_name' => $params['last_name'],
            'profile_path' => $params['profile_path'] ?? null,
            'email' => $params['email'] ?? null,
            'phone' => $params['phone'] ?? null,
            'mobile' => $params['mobile'] ?? null,
            'address' => $params['address'] ?? null,
            'profile_path_remove' => $params['profile_path_remove'] ?? null,
            'is_active' => $params['is_active'] ?? null,
        ];
        $staffResult = $this->repository->update($id, $staffParams)->getData(true);
        if (isset($staffResult['error'])) {
            return $this->repository->error('Failed to update staff', [], $this->repository->internalServerError);
        }
        $shopStaffParams = [
            'shop_id' => $params['shop_ids'][0],
            'staff_id' => $staffResult['data']['id'],
            'employment_status' => $params['employment_status'],
            'hire_date' => $params['hire_date'],
        ];
        return $this->service->update($id, $params);
    }

    public function delete(int $id)
    {
        $result = null;
        $staffShops = $this->service->findManyByStaffId($id);
        if (count($staffShops) >= 1) {
            $fistShop = $staffShops[0];
            $result = $this->service->delete($fistShop->id);
        }
        $staffShops2 = $this->service->findManyByStaffId($id);
        if (count($staffShops2) === 0) {
            return $this->repository->delete($id);
        }

        return $result;
    }

    public function dropdown()
    {
        return $this->repository->dropdown();
    }
}
