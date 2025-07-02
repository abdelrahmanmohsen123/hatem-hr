<?php

namespace App\Http\Controllers\Api\CurrencyApi;

use Carbon\Carbon;
use App\Models\Country;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\EgyptCurrency;
use App\Jobs\UpdateCurrencyRates;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Jobs\UpdateGoldRates;
use Illuminate\Support\Facades\Http;

class CurrencyApiController extends Controller
{
    //
    use ApiResponse;

    public function getRates()
    {
        UpdateCurrencyRates::dispatch();
        return $this->respondWithSuccess("Rate update started");
        // Do something with the data
        // return response()->json($data);
    }

    public function getHistoryRates(){
        UpdateGoldRates::dispatch();
        return $this->respondWithSuccess("Rate History Gold update started");
    }

    // public function getRates()
    // {
    //     $apiKey = env('CURRENCY_API_KEY'); // Use .env for secrets
    //     $url = "https://api.currencyapi.com/v3/latest";

    //     // Get all currencies in one query
    //     $currencies = EgyptCurrency::with('country')->get()->keyBy('currency_code');

    //     // Get unique base currencies
    //     $baseCurrencies = $currencies->pluck('country.currency_code')
    //         ->unique()
    //         ->filter();

    //     foreach ($baseCurrencies as $base) {
    //         $response = Http::get($url, [
    //             'apikey' => $apiKey,
    //             'base_currency' => $base,
    //         ]);

    //         if ($response->failed()) {
    //             Log::error("API failed for base: $base", ['response' => $response->json()]);
    //             continue;
    //         }

    //         $rates = $response->json('data', []);
    //         $lastUpdated = Carbon::parse($response->json('meta.last_updated_at'));

    //         foreach ($rates as $currencyCode => $rateInfo) {
    //             if ($currency = $currencies->get($currencyCode)) {
    //                 $currency->update([
    //                     'price' => round(1 / $rateInfo['value'], 4),
    //                     'last_updated_at' => $lastUpdated
    //                 ]);
    //             }
    //         }

    //         sleep(20); // Maintain rate limit compliance
    //     }

    //     return $this->respondWithSuccess("Exchange rates updated successfully");
    // }
}
