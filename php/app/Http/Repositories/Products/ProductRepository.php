<?php

namespace App\Http\Repositories\Products;

use DB;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Repositories\BaseRepository;
use App\Models\Products\Product;

class ProductRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Product();
    }

    public function all(array $params = [])
    {
        try {
            $query = $this->model->with([
                'brand',
                'category',
                'unit'
            ]);

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
        $brandParam = isset($params['brand_id']) ? $params['brand_id'] : null;
        $categoryParam = isset($params['category_id']) ? $params['category_id'] : null;
        $unitParam = isset($params['unit_id']) ? $params['unit_id'] : null;
        $isActiveParam = isset($params['is_active']) ? $params['is_active'] : null;

        if ($nameParam) {
            $query = $query->whereLike('name', '%'.$nameParam.'%');
        }

        if ($brandParam) {
            $query = $query->whereHas('brand', function($brandQuery) use($brandParam) {
                $brandQuery->where('id', $brandParam);
            });
        }

        if ($categoryParam) {
            $query = $query->whereHas('brand', function($categoryQuery) use($categoryParam) {
                $categoryQuery->where('id', $categoryParam);
            });
        }

        if ($unitParam) {
            $query = $query->whereHas('brand', function($unitQuery) use($unitParam) {
                $unitQuery->where('id', $unitParam);
            });
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
            if (isset($params['logo_path']) && $params['logo_path'] instanceof \Illuminate\Http\UploadedFile) {
                $file = $params['logo_path'];
                unset($params['logo_path']);
            }

            $product = $this->model->create($params);

            if ($file) {
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs(
                    config('const.product_logo_path').$product->id.'/logo',
                    $filename,
                    'public'
                );

                $product->update([
                    'logo_path' => $path
                ]);
            }

            return $product;
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
            $product = $this->model->find($id);
            if (isset($params['logo_path']) && $params['logo_path'] instanceof \Illuminate\Http\UploadedFile) {
                $file = $params['logo_path'];
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs(
                    config('const.product_logo_path').$product->id.'/logo',
                    $filename,
                    'public'
                );
            }

            if (!isset($product)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $product->update($params);
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
            $product = $this->model->find($id);

            if (!isset($product)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            return $product->delete();
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