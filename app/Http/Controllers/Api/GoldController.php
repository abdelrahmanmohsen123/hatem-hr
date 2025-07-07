<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CurrencyPrice;
use App\Http\Controllers\Controller;
use App\Http\Resources\Currencies\CurrencyIndexResource;
use App\Http\Resources\Golds\GoldIndexResource;
use App\Models\GoldPrice;
use App\Traits\ApiResponder;

class GoldController extends Controller
{
    use ApiResponder;
    //
     public function index(){
        $currency_id = 3;
        $gold_prices = GoldPrice::where('currency_id',$currency_id)->get();
        return $this->respondResource(GoldIndexResource::collection($gold_prices));

    }
}
