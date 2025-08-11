<?php

namespace App\Http\Resources\Currencies;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'target_currency'=>$this->Target_currency->{'name_'.$request->header('lang')},
            'icon_target_currency'=>uploadsPath($this->Target_currency->icon),
            'base_rate'=>number_format($this->base_rate,2),
            'target_rate'=>number_format($this->target_rate,2),
            'status_price'=>$this->status_price,
            'ordering'=>$this->ordering,
            'latest_updated'=>Carbon::parse($this->latest_updated)->format('Y-m-d H:i:s'),
        ];
    }
}
