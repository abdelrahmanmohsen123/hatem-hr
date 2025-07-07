<?php

namespace App\Http\Resources\Bullions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BullionIndexResource extends JsonResource
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
            'name' =>$this->bullion->{'name_'.$request->header('lang')},
            'icon' =>uploadsPath($this->bullion->icon),
            'base_price' => $this->base_price,
            'dollar_price' => $this->dollar_price,
            'latest_updated' => Carbon::parse($this->latest_updated)->format('Y-m-d H:i:s'),
        ];
    }
}
