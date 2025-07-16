<?php

namespace App\Http\Controllers\Api\Admin\Admins;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Visit;
use App\Models\Currency;
use App\Models\GoldPrice;
use App\Models\BullionPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\CurrencyPrice;
use App\Support\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authentication\StoreAccountRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Gold\UpdateGoldRequest;
use App\Http\Requests\Admin\Visit\StoreVisitRequest;
use App\Http\Resources\Admin\Gold\GoldIndexResource;
use App\Http\Requests\Admin\Visit\UpdateVisitRequest;
use App\Http\Resources\Admin\Visit\VisitShowResource;
use App\Http\Resources\Admin\Visit\VisitIndexResource;
use App\Http\Requests\Admin\Bullion\UpdateBullionRequest;
use App\Http\Resources\Admin\Authentication\AdminResource;
use App\Http\Resources\Admin\Bullion\BullionIndexResource;
use App\Http\Requests\Admin\Currency\UpdateCurrencyRequest;
use App\Http\Resources\Admin\Currency\CurrencyIndexResource;
use App\Http\Requests\Admin\Authentication\UpdateProfileRequest;

class AdminController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $admins = Admin::all();
        return $this->respondResource(AdminResource::collection($admins));
    }


    public function show(string $id)
    {
        return $this->respondResource(new AdminResource(Admin::findOrFail($id)));
    }

     public function update(UpdateProfileRequest $request, string $id)
    {
        $admin = Admin::find($id);
        // dd($request->all());
        $updateData = [];
        if ($request->has('name') && $request->name !== $admin->name) {
            $updateData['name'] = $request->name;
        }
        if ($request->has('password')) {
            $updateData['password'] = Hash::make($request->passsword);
        }
        $admin->update($updateData);
        return $this->respondResource(new AdminResource($admin), [
            'message' => __('auth.profile_updated'),
        ]);
    }

     public function store(StoreAccountRequest $request)
    {
       
        $data = $request->validated();
        // dd($data);
        $data['password'] = Hash::make($request->passsword);
        $data['name'] = $data['name'] ?? 'Admin';
        $Admin = Admin::create($data);
        return $this->respondResource(new AdminResource($Admin), [
            'message' => __('auth.account_created'),
        ]);
    }

    public function delete(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return $this->respondWithSuccess(__('auth.account_deleted_successfully'));
    }

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
}
