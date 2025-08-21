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
            'name' => $this->bullion->{'name_' . $request->header('lang')},
            'icon' => uploadsPath($this->bullion->icon),
            // 'base_price' => number_format($this->base_price, 2),
            // 'dollar_price' => number_format($this->dollar_price, 2),

            'base_price' => number_format(
                (float)$this->base_price * (1 + (float)($this->bullion->percentage_increase ?? 0) / 100),
                2
            ),
            'dollar_price' => number_format(
                (float)$this->dollar_price * (1 + (float)($this->bullion->percentage_increase ?? 0)  / 100),
                2
            ),
            'latest_updated' => (string) Carbon::parse($this->updated_at)->valueOf(),
        ];
    }
}
