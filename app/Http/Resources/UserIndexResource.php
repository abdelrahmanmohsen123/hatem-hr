<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
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
            'username' => $this->username,
            'age' => $this->age,
            'experience' => $this->experience,
            'national_id' => $this->national_id,
            // 'description' => $this->description,
            'balance_vacations_days' => $this->balance_vacations_days,
            'user_id' => $this->user_id,
        ];
    }
}
