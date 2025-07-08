<?php

namespace App\Http\Controllers\Api;

use App\Models\BullionPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Bullion\BullionIndexResource;

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
        return $this->respondResource(BullionIndexResource::collection($bullion_prices));
    }

    //
}
