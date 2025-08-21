<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\BullionPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Bullions\BullionIndexResource;

class BullionController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $currency_id = 3;
        $bullion_prices = BullionPrice::where('currency_id', $currency_id)
            ->where('status', true)
            ->orderBy('id', 'asc') // or replace 'id' with your desired column
            ->get();


        $latestUpdate = optional($bullion_prices->first())->latest_update;
        // dd($bullion_prices->first());

        return $this->respondResource(BullionIndexResource::collection($bullion_prices),[
            'latest_updated'=> (string) Carbon::parse($latestUpdate)->valueOf(),
        ]);
    }

    //
}
