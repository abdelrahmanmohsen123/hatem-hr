<?php

namespace App\Http\Controllers\Api\CurrencyApi;


use Carbon\Carbon;
use App\Models\Country;
use App\Traits\ApiResponse;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Jobs\UpdateGoldRates;
use App\Models\EgyptCurrency;
use App\Jobs\UpdateCurrencyRate;
use App\Jobs\UpdateCurrencyRates;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CurrencyApiController extends Controller
{
    //
    use ApiResponder;

    public function getRates()
    {
        try {
            // dd('hi');
            UpdateCurrencyRate::dispatch()->onConnection('database'); 
            return $this->respondWithSuccess("Rate update started");
        } catch (\Exception $e) {
            Log::error('Currency Job Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }
        // Do something with the data
        // return response()->json($data);
    }

   

    
}
