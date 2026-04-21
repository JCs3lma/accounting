<?php

namespace App\Http\Repositories\Shops;

use DB;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Repositories\BaseRepository;
use App\Models\Shops\PurchaseOrder;

class ShopRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new PurchaseOrder();
    }

    public function all(array $params = [])
    {
        try {
            $query = $this->model->query();

            $query = $this->filters($query, $params);

            $data = $query->paginate(10)->withQueryString();
            
            return $data;
        } catch (Exception $e) {
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return null;
        }
    }

    private function filters(Builder $query, array $params = [])
    {
        if (empty($params)) {
            return $query;
        }

        $shopNameParam = isset($params['shop_name']) ? $params['shop_name'] : null;
        $contactPersonParam = isset($params['contact_person']) ? $params['contact_person'] : null;
        $emailParam = isset($params['email']) ? $params['email'] : null;
        $phoneParam = isset($params['phone']) ? $params['phone'] : null;
        $mobileParam = isset($params['mobile']) ? $params['mobile'] : null;
        $addressParam = isset($params['address']) ? $params['address'] : null;
        $isActiveParam = isset($params['is_active']) ? $params['is_active'] : null;

        if ($shopNameParam) {
            $query->whereLike('shop_name', '%'.$shopNameParam.'%');
        }

        if ($contactPersonParam) {
            $query->whereLike('contact_person', '%'.$contactPersonParam.'%');
        }

        if ($emailParam) {
            $query->whereLike('email', '%'.$emailParam.'%');
        }

        if ($phoneParam) {
            $query->whereLike('phone', '%'.$phoneParam.'%');
        }

        if ($mobileParam) {
            $query->whereLike('mobile', '%'.$mobileParam.'%');
        }

        if ($addressParam) {
            $query->whereLike('address', '%'.$addressParam.'%');
        }

        if ($isActiveParam && $isActiveParam !== 'All') {
            $isActive = filter_var($isActiveParam, FILTER_VALIDATE_BOOLEAN);
            $query->where('is_active', $isActive);
        }

        return $query;
    }

    public function create(array $params = [])
    {
        if (empty($params)) {
            return $this->error('Empty parameters', [], $this->badRequest);
        }

        try {
            DB::beginTransaction();
            $shop = $this->model->create($params);

            if ($shop) {
                $shop->update(['po_number' => str_pad($shop->id, 4, '0', STR_PAD_LEFT)]);
            }

            DB::commit();
            return $this->success($shop, 'Purchase Order created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }

    public function update(int $id, array $params = [])
    {
        if (!$id) {
            return $this->error('ID should be present', [], $this->badRequest);
        }

        if (empty($params)) {
            return $this->error('Empty parameters', [], $this->badRequest);
        }

        try {
            $shop = $this->model->find($id);

            if (!isset($shop)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            DB::beginTransaction();
            $shop->update($params);

            $newShop = $this->model->find($id);
            DB::commit();
            return $this->success($newShop, 'Shop updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }

    public function delete(int $id)
    {
        if (!$id) {
            return $this->error('ID should be present', [], $this->badRequest);
        }

        try {
            $shop = $this->model->find($id);

            if (!isset($shop)) {
                return $this->error('Data not found', [], $this->notFound);
            }
            DB::beginTransaction();
            $shop->delete();
            DB::commit();
            return $this->success([], 'Shop deleted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }

    public function dropdown()
    {
        return $this->model->where('is_active', true)->get();
    }
}
