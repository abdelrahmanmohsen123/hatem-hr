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
        // Ensure numeric values are properly cast to float before formatting
        $basePrice = is_numeric($this->base_price) ? (float) $this->base_price : 0.0;
        $dollarPrice = is_numeric($this->dollar_price) ? (float) $this->dollar_price : 0.0;
        $changeAmount = is_numeric($this->change_amount) ? (float) $this->change_amount : 0.0;
        return [
            'id' => $this->id,
            'name' =>$this->gold->{'name_'.$request->header('lang')},
            'icon' =>uploadsPath($this->gold->icon),
            'base_price' => number_format($basePrice,2),
            'dollar_price' => number_format($dollarPrice,2),
            'base_price_nonformate'=> (float) round($this->base_price,5),
            'dollar_price_nonformate'=> (float) round($this->dollar_price,5),


            'status_price' => $this->status_price,
             'change_amount' => $changeAmount ? number_format($changeAmount,1) : '0',
            'latest_updated' => (string) Carbon::parse($this->latest_updated)->valueOf(),
        ];
    }
}
