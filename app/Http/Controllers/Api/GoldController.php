<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\GoldPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\CurrencyPrice;
use App\Http\Controllers\Controller;
use App\Http\Resources\Golds\GoldIndexResource;
use App\Http\Resources\Currencies\CurrencyIndexResource;

class GoldController extends Controller
{
    use ApiResponder;
    //
    public function index()
    {
        $currency_id = 3;
        $gold_prices = GoldPrice::where('currency_id', $currency_id)
            ->where('status', true)
            ->orderBy('id', 'asc') // or replace 'id' with your desired column
            ->get();


        $latestUpdate = optional($gold_prices->first())->latest_update;

        return $this->respondResource(GoldIndexResource::collection($gold_prices),[
            'latest_updated'=> Carbon::parse($latestUpdate)->format('Y-m-d H:i:s.v'),
        ]);
    }
}
