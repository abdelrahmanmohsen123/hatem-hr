<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\Setting\SettingsIndexResource;
use App\Models\Setting;
use App\Support\FileUploader;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Admin\Settings\SettingIndexResource;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;
use App\Traits\ApiResponder;

class SettingController extends Controller
{
    use ApiResponder;
    public function index()
    {
        $setting = Setting::first();
        if (!$setting) {
            return $this->setStatusCode(404)->respondWithError(__('general.Setting not found'), 404);
        }
        //
        return $this->respondResource(new  SettingsIndexResource($setting));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::first();
        if (!$setting) {
            return $this->setStatusCode(404)->respondWithError(__('general.Setting not found'), 404);
        }
        //
        $data = $request->validated();
        if ($request->image_path) {
            if ($setting->image_path) {
                Storage::disk('public')->delete($setting->image_path);
            }
            $data['image_path'] = (new FileUploader())->saveBase64Image($request->image_path, 'settings');
        }
        $setting->update($data);
        return $this->respondResource(new SettingsIndexResource($setting), [
            'message' => __('general.Updated successfully')
        ]);
    }
}
