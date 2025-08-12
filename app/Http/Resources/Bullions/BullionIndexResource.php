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
                $this->base_price + ($this->base_price * $this->bullion->percentage_increase / 100),
                2
            ),
            'dollar_price' => number_format(
                $this->dollar_price + ($this->dollar_price * $this->bullion->percentage_increase / 100),
                2
            ),
            'latest_updated' => Carbon::parse($this->latest_updated)->format('Y-m-d H:i:s'),
        ];
    }
}
