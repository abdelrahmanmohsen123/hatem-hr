<?php

namespace App\Http\Resources\Golds;

use BcMath\Number;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoldIndexResource extends JsonResource
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
            'name' =>$this->gold->{'name_'.$request->header('lang')},
            'icon' =>uploadsPath($this->gold->icon),
            'base_price' => number_format($this->base_price,2),
            'dollar_price' => number_format($this->dollar_price,2),
            'status_price' => $this->status_price,
             'change_amount' => $this->change_amount ? number_format($this->change_amount,1) : '0',
            'latest_updated' => Carbon::parse($this->latest_updated)->format('Y-m-d H:i:s'),
        ];
    }
}
