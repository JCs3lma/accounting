<?php

namespace App\Http\Repositories\Products;

use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Repositories\BaseRepository;
use App\Models\Products\Unit;

class UnitRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Unit();
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

        $nameParams = isset($params['name']) ? $params['name'] : null;
        $abbreviationParams = isset($params['abbreviation']) ? $params['abbreviation'] : null;
        $isActiveParams = isset($params['is_active']) ? $params['is_active'] : null;

        if ($nameParams) {
            $query = $query->whereLike('name', '%'.$nameParams.'%');
        }

        if ($abbreviationParams) {
            $query = $query->where('abbreviation', $abbreviationParams);
        }

        if ($isActiveParams) {
            $query = $query->where('is_active', $isActiveParams);
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
        if (!$id) {
            return $this->error('ID should be present', [], $this->badRequest);
        }

        if (empty($params)) {
            return $this->error('Empty parameters', [], $this->badRequest);
        }

        try {
            $unit = $this->model->find($id);

            if (!isset($unit)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $unit->update($params);
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
            $unit = $this->model->find($id);

            if (!isset($unit)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $unit->delete();
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