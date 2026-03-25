<?php

namespace App\Http\Repositories\Products;

use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Repositories\BaseRepository;
use App\Models\Products\Pricing;

class PricingRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Pricing();
    }

    public function all(array $params = [])
    {
        try {
            $query = $this->model->with('product');

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
        $productParam = isset($params['product_id']) ? $params['product_id'] : null;
        $isActiveParam = isset($params['is_active']) ? $params['is_active'] : null;

        if ($nameParam) {
            $query = $query->whereHas('product', function (Builder $productQuery) use ($nameParam) {
                $productQuery->whereLike('name', '%'.$nameParam.'%');
            });
        }

        if ($productParam) {
            $query = $query->where('product_id', '%'.$productParam.'%');
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
            if ($params['is_active']) {
                $this->model
                    ->where('product_id', $params['product_id'])
                    ->update(['is_active', false]);
            }

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
            $price = $this->model->find($id);

            if ($params['is_active']) {
                $this->model
                    ->where('product_id', $params['product_id'])
                    ->update(['is_active', false]);
            }

            if (!isset($price)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $price->update($params);
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
            $price = $this->model->find($id);

            if (!isset($price)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $price->delete();
        } catch (Exception $e) {
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }
}