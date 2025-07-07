<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Country;
use App\Models\Currency;
use App\Models\CurrencyPrice;
use App\Models\EgyptBar;
use App\Models\EgyptCurrency;
use App\Models\EgyptGold;
use App\Models\EgyptSilver;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateCurrencyRates implements ShouldQueue
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
     
        $apiKey = config('services.currencyapi.key');
        $url = "https://api.currencyapi.com/v3/latest";



        $base_currency = 'SAR';
        $response = Http::get($url, [
            'apikey' => $apiKey,
            'base_currency' => $base_currency // Add your desired currencies here
        ]);
        dd($response);
        // Handle error if needed
        if ($response->failed()) {

            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
        // Decode JSON response
        $rates = $response->json('data'); // Just the "data" part
        // dd($rates);
        $meta = $response->json('meta');
        $latest_update = Carbon::parse($meta['last_updated_at']);


        foreach ($rates as $code => $info) {
            // dd($code,$info);
            if (!$info['value'] || $info['value'] == 0) continue;
            $USD =  $rates['USD']['value'];
            if ($code === 'XAU') {

                // $onsa = 1 / $info['value'];
                // $this->updateGoldPrices($base_currency, $onsa, $USD);
                // $this->updateBarPrices($base_currency, $onsa, $USD);
                continue; // ننتقل للعنصر التالي لأن سعر الذهب لا علاقة له بالعملة
            }



            // Match the code in your DB

            $base_currency = Currency::where('code', $base_currency)->first();
            $target_currency = Currency::where('code', $info['code'])->first();
            $currency_price = CurrencyPrice::where('base_currency_id', $base_currency->id)->where('target_currency_id', $target_currency->id)->first();
            $oldValue = $currency_price->base_rate;
            $newValue = round((1 / $info['value']), 4);
            $targetValue = round($info['value'], 4);
            $difference = round(abs($newValue - $oldValue), 4); // absolute value of difference
            if ($newValue > $oldValue) {
                $status = 'up';
            } elseif ($newValue < $oldValue) {
                $status = 'down';
            } else {
                $status = $currency_price->status_price;
            }
            if ($currency_price) {
                $currency_price->base_rate = $newValue;
                $currency_price->target_rate = $targetValue;
                $currency_price->status_price = $status;
                $currency_price->last_updated_at =  $latest_update;
                $currency_price->save();
            } else {
                CurrencyPrice::create([
                    'base_rate' => $newValue,
                    'target_rate' => $targetValue,
                    'status_price' => $status,
                    'base_currency_id' => $base_currency->id,
                    'target_currency_id' => $target_currency->id,
                ]);
            }
        }
    }

    // function updateGoldPrices($country_id, $onsa, $USD)
    // {
    //     $goldItems = EgyptGold::where('country_id', $country_id)
    //         ->whereIn('name_ar', [
    //             'أونصة ذهب',
    //             'عيار 24',
    //             'عيار 22',
    //             'عيار 21',
    //             'عيار 18',
    //             'عيار 14',
    //             'عيار 12',
    //             'عيار 10',
    //             'عيار 9',
    //             'عيار 8',
    //             'جنيه ذهب'
    //         ])->get()->keyBy('name_ar');

    //     $gram_24 = $onsa / 31.1035;


    //     $rates = [
    //         'أونصة ذهب' => $onsa,
    //         'عيار 24' => $gram_24,
    //         'عيار 22' => $gram_24 * 0.916,
    //         'عيار 21' => $gram_24 * 0.875,
    //         'عيار 18' => $gram_24 * 0.75,
    //         'عيار 14' => $gram_24 * 0.583,
    //         'عيار 12' => $gram_24 * 0.5,
    //         'عيار 10' => $gram_24 * 0.4167,
    //         'عيار 9' => $gram_24 *  0.375,

    //         'عيار 8' => $gram_24 *  0.3333,
    //         'جنيه ذهب' => $gram_24 * 0.875 * 8, // 8 جرام × عيار 21
    //     ];

    //     foreach ($rates as $name => $price) {
    //         if (isset($goldItems[$name])) {

    //             if (round($price, 4) > $goldItems[$name]->price) {
    //                 $status = 'up';
    //             } elseif (round($price, 4) < $goldItems[$name]->price) {
    //                 $status = 'down';
    //             } else {
    //                 $status = $goldItems[$name]->status_price ?? 'up';
    //             }

    //             if (round($price * $USD, 4) > $goldItems[$name]->dollar_price) {
    //                 $status_dollar = 'up';
    //             } elseif (round($price * $USD, 4) < $goldItems[$name]->price) {
    //                 $status_dollar = 'down';
    //             } else {
    //                 $status_dollar = $goldItems[$name]->status_dollar_price;
    //             }

    //             if ($goldItems[$name] == 'أونصة ذهب') {
    //                 if (round($price * $USD, 4) > $goldItems[$name]->price_yesterday) {
    //                     $status_price_yesterday = 'up';
    //                     $different_price = abs(round($price * $USD, 4) - $goldItems[$name]->price_yesterday);
    //                 } elseif (round($price * $USD, 4) < $goldItems[$name]->price) {
    //                     $status_price_yesterday = 'down';
    //                     $different_price = abs(round($price * $USD, 4) - $goldItems[$name]->price_yesterday);
    //                 } else {
    //                     $status_price_yesterday = $goldItems[$name]->status_price_yesterday;
    //                     $different_price =  $goldItems[$name]->price_yesterday;
    //                 }
    //             }
    //             $goldItems[$name]->price = round($price, 4);
    //             $goldItems[$name]->status_price = $status;
    //             $goldItems[$name]->dollar_price = round($price * $USD, 4);
    //             $goldItems[$name]->status_dollar_price = $status_dollar;


    //             $goldItems[$name]->status_price_yesterday = $status_price_yesterday ?? $goldItems[$name]->status_price_yesterday;
    //             $goldItems[$name]->different_price = $different_price ?? $goldItems[$name]->different_price;



    //             $goldItems[$name]->save();
    //         }
    //     }
    // }


    // function updateSilverPrices($country_id, $onsa, $USD)
    // {
    //     $silverItems = EgyptSilver::where('country_id', $country_id)
    //         ->whereIn('name_ar', [
    //             'اونصة فضة',
    //             'فضة 925',
    //             'فضة 800',
    //             'فضة 999',
    //             'فضة 950',
    //             'فضة 960',
    //             'فضة 947',
    //             'فضة 958'
    //         ])->get()->keyBy('name_ar');

    //     // سعر جرام الفضة بالاونصة
    //     $gram_base = $onsa / 31.1035;

    //     // معاملات الشوائب (النقاء) الخاصة بالفضة، مثلا عيار 925 يعني 92.5%
    //     $rates = [
    //         'اونصة فضة' => $onsa,
    //         'فضة 999' => $gram_base * 0.999,
    //         'فضة 958' => $gram_base * 0.958,
    //         'فضة 960' => $gram_base * 0.960,
    //         'فضة 947' => $gram_base * 0.947,
    //         'فضة 950' => $gram_base * 0.950,
    //         'فضة 925' => $gram_base * 0.925,
    //         'فضة 800' => $gram_base * 0.800,
    //     ];

    //     foreach ($rates as $name => $price) {
    //         if (isset($silverItems[$name])) {
    //             if (round($price, 4) > $silverItems[$name]->price) {
    //                 $status = 'up';
    //             } elseif (round($price, 4) < $silverItems[$name]->price) {
    //                 $status = 'down';
    //             } else {
    //                 $status = $silverItems[$name]->status_price ?? 'up';
    //             }

    //             if (round($price * $USD, 4) > $silverItems[$name]->dollar_price) {
    //                 $status_dollar = 'up';
    //             } elseif (round($price * $USD, 4) < $silverItems[$name]->price) {
    //                 $status_dollar = 'down';
    //             } else {
    //                 $status_dollar = $silverItems[$name]->status_dollar_price;
    //             }
    //             $silverItems[$name]->price = round($price, 4);
    //             $silverItems[$name]->status_price = $status;
    //             $silverItems[$name]->dollar_price = round($price * $USD, 4);
    //             $silverItems[$name]->status_dollar_price = $status_dollar;
    //             $silverItems[$name]->save();
    //         }
    //     }
    // }

    // function updateBarPrices($country_id, $onsa, $USD)
    // {
    //     $barNames = array_column(EgyptBar::$bar_name, 'ar'); // assuming you're inside the same class
    //     $barItems = EgyptBar::where('country_id', $country_id)
    //         ->whereIn('name_ar', $barNames)->get()->keyBy('name_ar');


    //     $gram_24 = $onsa / 31.1035;


    //     $bar_weights = [
    //         'سبيكة 1 جرام'       => 1,
    //         'سبيكة 2.5 جرام'     => 2.5,
    //         'سبيكة 5 جرام'       => 5,
    //         'سبيكة 10 جرام'      => 10,
    //         'سبيكة 20 جرام'      => 20,
    //         'سبيكة 50 جرام'      => 50,
    //         'سبيكة 100 جرام'     => 100,
    //         'سبيكة 250 جرام'     => 250,
    //         'سبيكة 500 جرام'     => 500,
    //         'سبيكة 1 كيلو'       => 1000,
    //         'سبيكة 1 أونصة'      => 31.1035,
    //         'سبيكة نصف أونصة'    => 31.1035 / 2,
    //         'سبيكة التولة'       => 11.6638,
    //         'سبيكة أوقية'        => 31.1035, // Same as ounce
    //         // Coins (جنيهات)
    //         'الجنية عيار 21'     => ['weight' => 8, 'karat' => 0.875],
    //         'الجنية عيار 22'     => ['weight' => 8, 'karat' => 0.916],
    //         'الجنية عيار 24'     => ['weight' => 8, 'karat' => 1],
    //     ];

    //     $bar_rates = [];

    //     foreach ($bar_weights as $name => $info) {
    //         if (is_array($info)) {
    //             // Coin (has weight + karat)
    //             $weight = $info['weight'];
    //             $karat = $info['karat'];
    //             $bar_rates[$name] = round($gram_24 * $karat * $weight, 2);
    //         } else {
    //             // Standard bar (pure 24K)
    //             $bar_rates[$name] = round($gram_24 * $info, 2);
    //         }
    //     }

    //     foreach ($bar_rates as $name => $price) {

    //         if (isset($barItems[$name])) {

    //             if (round($price, 4) > $barItems[$name]->price) {
    //                 $status = 'up';
    //             } elseif (round($price, 4) < $barItems[$name]->price) {
    //                 $status = 'down';
    //             } else {
    //                 $status = $barItems[$name]->status_price ?? 'up';
    //             }

    //             if (round($price * $USD, 4) > $barItems[$name]->dollar_price) {
    //                 $status_dollar = 'up';
    //             } elseif (round($price * $USD, 4) < $barItems[$name]->price) {
    //                 $status_dollar = 'down';
    //             } else {
    //                 $status_dollar = $barItems[$name]->status_dollar_price;
    //             }
    //             $barItems[$name]->price = round($price, 4);
    //             $barItems[$name]->status_price = $status;
    //             $barItems[$name]->dollar_price = round($price * $USD, 4);
    //             $barItems[$name]->status_dollar_price = $status_dollar;
    //             $barItems[$name]->save();
    //         }
    //     }
    // }
}
