<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'image_path' => 'nullable',
            'android_version' => 'nullable|string',
            'ios_version' => 'nullable|string',
            'android_version_collector' => 'nullable|string',
            'ios_version_collector' => 'nullable|string',
            'force_update_android_version' => 'nullable|boolean',
            'force_update_ios_version' => 'nullable|boolean',
            'force_update_android_version_collector' => 'nullable|boolean',
            'force_update_ios_version_collector' => 'nullable|boolean',
            'app_active' => 'nullable|boolean',
            'wallet_number' => 'nullable|string',
            'instapay_number' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'instagram' => 'nullable|string',
            'facebook' => 'nullable|string',
            'youtube' => 'nullable|string',
            'tiktok' => 'nullable|string',
            'twitter' => 'nullable|string',

        ];
    }
}
