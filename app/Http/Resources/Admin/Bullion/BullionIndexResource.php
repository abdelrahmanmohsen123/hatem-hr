<?php

namespace App\Http\Resources\Admin\Bullion;

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
            // 'base_price' => $this->base_price,
            // 'dollar_price' => $this->dollar_price,
            'base_price' => number_format(
                $this->base_price + ($this->base_price * $this->bullion->percentage_increase / 100),
                2
            ),
            'dollar_price' => number_format(
                $this->dollar_price + ($this->dollar_price * $this->bullion->percentage_increase / 100),
                2
            ),
            'status_price' => $this->status_price,
            'status' => (bool) $this->status,
            'ordering' =>  $this->ordering,
            'percentage_increase'=>$this->bullion->percentage_increase,
            'change_amount' => $this->change_amount ? number_format($this->change_amount, 1) : '0',
            'latest_updated' => Carbon::parse($this->latest_updated)->format('Y-m-d H:i:s'),
        ];
    }
}
