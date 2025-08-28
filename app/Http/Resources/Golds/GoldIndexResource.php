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
            'base_price' => is_numeric($this->base_price) ? number_format($this->base_price, 2) : $this->base_price,
            'dollar_price' => is_numeric($this->dollar_price) ? number_format($this->dollar_price, 2) : $this->dollar_price ,
            'base_price_nonformate'=> (float) $this->base_price,
            'dollar_price_nonformate'=> (float) $this->dollar_price,

            'status_price' => $this->status_price,
             'change_amount' => $this->change_amount && $this->change_amount > 0 ? number_format($this->change_amount,1) : '0',
            'latest_updated' => (string) Carbon::parse($this->latest_updated)->valueOf(),
        ];
    }
}
