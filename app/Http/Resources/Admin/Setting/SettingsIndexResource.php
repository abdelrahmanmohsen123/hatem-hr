<?php

namespace App\Http\Resources\Admin\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image_path' => uploadsPath($this->image_path),
            'android_version' => $this->android_version,
            'ios_version' => $this->ios_version,

            
            'force_update_android_version' => $this->force_update_android_version,
            'force_update_ios_version' => $this->force_update_ios_version,

            
            'app_active' => $this->app_active,
            'whatsapp' => $this->whatsapp,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'youtube' => $this->youtube,
            'tiktok' => $this->tiktok,
            'twitter' => $this->twitter,

        ];
    }
}
