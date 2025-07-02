<?php

namespace App\Jobs;

use App\Models\Country;
use Carbon\Carbon;
use App\Models\EgyptGold;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateGoldRates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd('hi');
        $apiKey = 'cur_live_BY9A5i9zBWK7P3MaabjymHpDnxvlyjuJ2ru6Jm1B';
        $url = "https://api.currencyapi.com/v3/historical";
        // dd($url);


        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get($url, [
            'apikey' => $apiKey,
            'base_currency' => 'USD',
            'currencies' => 'XAU',
            'date' => date('Y-m-d', strtotime('-1 day'))
        ]);
        // Handle error if needed
        if ($response->failed()) {

            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
        // Decode JSON response
        $rates = $response->json('data'); // Just the "data" part
        $meta = $response->json('meta');


        $value = $rates['XAU']['value'];

        $onsaByDollar = 1 / $value;


        $this->updateGoldPrices($onsaByDollar);

       


    }

    function updateGoldPrices($onsa)
    {
        $countries = Country::get();

        foreach ($countries as $country) {
            if($country->id == 1) continue;


            $goldItems = EgyptGold::where('country_id', $country->id)
                ->whereIn('name_ar', [
                    'أونصة ذهب',
                ])->get()->keyBy('name_ar');

            $gram_24 = $onsa / 31.1035;


            $rates = [
                'أونصة ذهب' => $onsa,

            ];

            foreach ($rates as $name => $price) {
                if (isset($goldItems[$name])) {
                    $goldItems[$name]->price_yesterday = round($price, 4);
                    $goldItems[$name]->different_price = abs(round($price, 4) - $goldItems[$name]->dollar_price);
                  
                    if (round($price, 4) > $goldItems[$name]->dollar_price) {
                        $status = 'down';
                    } elseif (round($price, 4) < $goldItems[$name]->dollar_price) {
                        $status = 'up';
                    } else {
                        $status = $goldItems[$name]->status_price_yesterday ?? 'up';
                    }

                    $goldItems[$name]->status_price_yesterday = $status;
                    $goldItems[$name]->save();
                }
            }
        }
    }
}
