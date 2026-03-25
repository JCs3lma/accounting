<?php

namespace App\Http\Repositories\Products;

use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Repositories\BaseRepository;
use App\Models\Products\Supplier;

class SupplierRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Supplier();
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

        $nameParam = isset($params['name']) ? $params['name'] : null;
        $contactPersonParam = isset($params['contact_person']) ? $params['contact_person'] : null;
        $emailParam = isset($params['email']) ? $params['email'] : null;
        $phoneParam = isset($params['phone']) ? $params['phone'] : null;
        $mobileParam = isset($params['mobile']) ? $params['mobile'] : null;
        $addressParam = isset($params['address']) ? $params['address'] : null;
        $isActiveParam = isset($params['is_active']) ? $params['is_active'] : null;

        if ($nameParam) {
            $query = $query->whereLike('name', '%'.$nameParam.'%');
        }

        if ($contactPersonParam) {
            $query = $query->whereLike('contact_person', '%'.$contactPersonParam.'%');
        }

        if ($emailParam) {
            $query = $query->whereLike('email', '%'.$emailParam.'%');
        }

        if ($phoneParam) {
            $query = $query->whereLike('phone', '%'.$phoneParam.'%');
        }

        if ($mobileParam) {
            $query = $query->whereLike('mobile', '%'.$mobileParam.'%');
        }

        if ($addressParam) {
            $query = $query->whereLike('address', '%'.$addressParam.'%');
        }

        if ($isActiveParam) {
            $query = $query->where('is_active', $isActiveParam);
        }

        return $query;
    }

    public function create(array $params = [])
    {
        if (empty($params)) {
            return $this->error('Empty parameters', [], $this->badRequest);
        }

        try {
            return $this->model->create($params);
        } catch (Exception $e) {
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }

    public function update(int $id, array $params = [])
    {
        if (empty($id)) {
            return $this->error('ID should be present', [], $this->badRequest);
        }

        if (empty($params)) {
            return $this->error('Empty parameters', [], $this->badRequest);
        }

        try {
            $supplier = $this->model->find($id);

            if (!isset($supplier)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $supplier->update($params);
        } catch (Exception $e) {
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }

    public function delete(int $id)
    {
        if ($id) {
            return $this->error('ID should be present', [], $this->badRequest);
        }

        try {
            $supplier = $this->model->find($id);

            if (!isset($supplier)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $supplier->delete();
        } catch (Exception $e) {
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }

    public function dropdown()
    {
        return $this->model->where('is_active', true)->get();
    }
}
