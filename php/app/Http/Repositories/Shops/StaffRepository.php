<?php

namespace App\Http\Repositories\Shops;

use DB;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Repositories\BaseRepository;
use App\Models\Shops\Staff;
use App\Helper\FileHelper;

class StaffRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Staff();
        $this->helper = new FileHelper();
    }

    public function all(array $params = [], int $shopId)
    {
        try {
            $query = $this->model->with([
                'shop'
            ])->whereHas('shop', function($shopQuery) use($shopId) {
                $shopQuery->where('shop_id', $shopId);
            });

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

        $shopIDParam = isset($params['shop_id']) ? $params['shop_id'] : null;
        $firstNameParam = isset($params['first_name']) ? $params['first_name'] : null;
        $lastNameParam = isset($params['last_name']) ? $params['last_name'] : null;
        $emailParam = isset($params['email']) ? $params['email'] : null;
        $phoneParam = isset($params['phone']) ? $params['phone'] : null;
        $mobileParam = isset($params['mobile']) ? $params['mobile'] : null;
        $addressParam = isset($params['address']) ? $params['address'] : null;
        $isActiveParam = isset($params['is_active']) ? $params['is_active'] : null;

        if ($firstNameParam) {
            $query->whereLike('first_name', '%'.$firstNameParam.'%');
        }

        if ($lastNameParam) {
            $query->whereLike('last_name', '%'.$lastNameParam.'%');
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
            $logoFile = isset($params['profile_path']) ? $params['profile_path'] : null;
            unset($params['profile_path']);
            unset($params['profile_path_remove']);
            $staff = $this->model->create($params);

            if ($logoFile instanceof UploadedFile) {
                $logoPath = $this->helper->uploadFile($logoFile, config('const.shops_logo_path').'staff/'.$staff->id);
                $staff->update(['profile_path' => $logoPath]);
            }

            DB::commit();
            return $this->success($staff, 'Staff created successfully!');
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
            $staff = $this->model->find($id);

            if (!isset($staff)) {
                return $this->error('Data not found', [], $this->notFound);
            }

            DB::beginTransaction();
            $logoFile = isset($params['profile_path']) ? $params['profile_path'] : null;
            $logoPathRemove = $params['profile_path_remove'];

            if ($logoPathRemove && !$logoFile) {
                $params['profile_path'] = null;
                if ($staff->profile_path) {
                    $this->helper->deleteFile($staff->getRawOriginal('profile_path'));
                }
            }

            if ($logoFile instanceof UploadedFile) {
                $params['profile_path'] = $this->helper->uploadFile($params['profile_path'], config('const.shops_logo_path').'staff/'.$id);
                if ($staff->profile_path) {
                    $this->helper->deleteFile($staff->getRawOriginal('profile_path'));
                }
            }
            $staff->update($params);
            $newStaff = $this->model->find($id);
            DB::commit();
            return $this->success($newStaff, 'Staff updated successfully!');
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
            $staff = $this->model->find($id);

            if (!isset($staff)) {
                return $this->error('Data not found', [], $this->notFound);
            }
            DB::beginTransaction();
            $staff->delete();
            DB::commit();
            return $this->success([], 'Staff deleted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(get_class().': '.__FUNCTION__.' function: '.$e);
            return $this->error('Something went wrong!', [$e->getMessage()], $this->internalServerError);
        }
    }
}
