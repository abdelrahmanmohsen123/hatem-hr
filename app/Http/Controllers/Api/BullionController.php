<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Bullions\BullionIndexResource;
use App\Models\BullionPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class BullionController extends Controller
{
    use ApiResponder;

    public function index(){
         $currency_id = 3;
        $bullion_prices = BullionPrice::where('currency_id',$currency_id)->get();
        return $this->respondResource(BullionIndexResource::collection($bullion_prices));

    }
     
    //
}
