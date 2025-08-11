<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Currencies\CurrencyIndexResource;
use App\Models\Currency;
use App\Models\CurrencyPrice;
use App\Traits\ApiResponder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    use ApiResponder;

    public function index()
    {
        $bas_currency_id = 3;


        $currencies = CurrencyPrice::where('base_currency_id', $bas_currency_id)
            ->where('id', '!=', '39')
            ->where('status', true)
            ->orderBy('ordering', 'asc') // or replace 'id' with your desired column
            ->get();

        $latestUpdate = optional($currencies->first())->latest_update;

        return $this->respondResource(CurrencyIndexResource::collection($currencies), [
            'latestUpdate' => Carbon::parse($latestUpdate)->format('Y-m-d H:i:s'),
        ]);
    }
}
