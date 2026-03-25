<?php

namespace App\Http\Repositories\Products;

use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Repositories\BaseRepository;
use App\Models\Products\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Category();
    }

    public function all(array $params = []) : ?LengthAwarePaginator
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
        $isActiveParam = isset($params['is_active']) ? $params['is_active'] : null;

        if ($nameParam) {
            $query = $query->whereLike('name', '%'.$nameParam.'%');
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
        if ($id) {
            return $this->error('ID should be present', [], $this->badRequest);
        }

        if (empty($params)) {
            return $this->error('Empty parameters', [], $this->badRequest);
        }

        try {
            $category = $this->model->find($id);

            if (!isset($category)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $category->update($params);
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
            $category = $this->model->find($id);

            if (!isset($category)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $category->delete();
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
