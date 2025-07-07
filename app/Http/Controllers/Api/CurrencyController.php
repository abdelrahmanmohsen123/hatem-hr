<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Currencies\CurrencyIndexResource;
use App\Models\Currency;
use App\Models\CurrencyPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    use ApiResponder;
    public function index(){
        $bas_currency_id = 3;
        $currencies = CurrencyPrice::where('base_currency_id',$bas_currency_id)->get();
        return $this->respondResource(CurrencyIndexResource::collection($currencies));

    }

}
