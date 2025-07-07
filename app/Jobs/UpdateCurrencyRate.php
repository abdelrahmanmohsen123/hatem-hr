<?php

namespace App\Jobs;

use App\Models\Bullion;
use App\Models\BullionPrice;
use Carbon\Carbon;
use App\Models\Gold;
use App\Models\Currency;
use App\Models\GoldPrice;
use App\Models\CurrencyPrice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateCurrencyRate
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
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

        // dd($response);
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

                $onsa = 1 / $info['value'];
                $this->updateGoldPrices($base_currency, $onsa, $USD);
                $this->updateBarPrices($base_currency, $onsa, $USD);
                continue; // ننتقل للعنصر التالي لأن سعر الذهب لا علاقة له بالعملة
            }



            // Match the code in your DB

            $base_currency_record = Currency::where('code', $base_currency)->first();
            // dd($base_currency);
            if (!$base_currency_record) continue;
            // dd($base_currency);
            $target_currency = Currency::where('code', $code)->first();
            if (!$target_currency) continue;
            // dd($target_currency);
            Log::info('Rates Fetched', ['base_currency' => $base_currency, 'target_currency' => $target_currency]);

            $newValue = round((1 / $info['value']), 4);
            $targetValue = round($info['value'], 4);

            $currency_price = CurrencyPrice::where('base_currency_id', $base_currency_record->id)->where('target_currency_id', $target_currency->id)->first();

            if ($currency_price) {
                $oldValue = $currency_price->base_rate;
                $difference = round(abs($newValue - $oldValue), 4); // absolute value of difference
                if ($newValue > $oldValue) {
                    $status = 'up';
                } elseif ($newValue < $oldValue) {
                    $status = 'down';
                } else {
                    $status = $currency_price->status_price;
                }
                $currency_price->base_rate = $newValue;
                $currency_price->target_rate = $targetValue;
                $currency_price->status_price = $status;
                $currency_price->latest_updated =  $latest_update;
                $currency_price->save();
            } else {

                // dd('hi');
                CurrencyPrice::create([
                    'base_rate' => $newValue,
                    'target_rate' => $targetValue,
                    'status_price' => 'up',
                    'base_currency_id' => $base_currency_record->id,
                    'target_currency_id' => $target_currency->id,

                ]);
            }
        }
    }

    function updateGoldPrices($base_currency, $onsa, $USD)
    {
        // $goldItems = Gold::where('status', 1)->get();

        $currency = Currency::where('code', $base_currency)->first();
        $gram_24 = $onsa / 31.1035;


        $rates = [
            'أونصة ذهب' => $onsa,
            'عيار 24' => $gram_24,
            'عيار 22' => $gram_24 * 0.916,
            'عيار 21' => $gram_24 * 0.875,
            'عيار 18' => $gram_24 * 0.75,
            'عيار 14' => $gram_24 * 0.583,
            'عيار 12' => $gram_24 * 0.5,
            'عيار 10' => $gram_24 * 0.4167,
            'عيار 9' => $gram_24 *  0.375,

            'عيار 8' => $gram_24 *  0.3333,
            'جنيه ذهب' => $gram_24 * 0.875 * 8, // 8 جرام × عيار 21
        ];

        foreach ($rates as $name => $price) {
            $gold = Gold::where('name_ar', $name)->first();
            $gold_price = GoldPrice::where('gold_id', $gold->id)->where('currency_id', $currency->id)->first();

            
            if ($gold_price) {

                $difference = round(abs($price - $gold_price->base_price), 4); // absolute value of difference

                // dd($difference);
                if (round($price, 4) > $gold_price->base_price) {
                    $status = 'up';
                } elseif (round($price, 4) < $gold_price->base_price) {
                    $status = 'down';
                } else {
                    $status = $gold_price->status_price ?? 'up';
                }

                $gold_price->base_price = round($price, 4);
                $gold_price->change_amount = $difference;
                $gold_price->status_price = $status;
                $gold_price->dollar_price = round($price * $USD, 4);

                $gold_price->save();
            } else {
                GoldPrice::create([
                    'gold_id' => $gold->id,
                    'currency_id' => $currency->id,
                    'base_price' => round($price, 4),
                    'dollar_price' => round($price * $USD, 4),
                    'status_price' => 'up',
                    'latest_updated' => now(),

                ]);
            }
        }
    }

    function updateBarPrices($base_currency, $onsa, $USD)
    {
        $currency = Currency::where('code', $base_currency)->first();
        $gram_24 = $onsa / 31.1035;


        $bar_weights = [
            'سبيكة 1 جرام'       => 1,
            'سبيكة 2.5 جرام'     => 2.5,
            'سبيكة 5 جرام'       => 5,
            'سبيكة 10 جرام'      => 10,
            'سبيكة 20 جرام'      => 20,
            'سبيكة 50 جرام'      => 50,
            'سبيكة 100 جرام'     => 100,
            'سبيكة 250 جرام'     => 250,
            'سبيكة 500 جرام'     => 500,
            'سبيكة 1 كيلو'       => 1000,
            'سبيكة 1 أونصة'      => 31.1035,
            'سبيكة نصف أونصة'    => 31.1035 / 2,
            'سبيكة التولة'       => 11.6638,
            'سبيكة أوقية'        => 31.1035, // Same as ounce
            // Coins (جنيهات)
            'الجنية عيار 21'     => ['weight' => 8, 'karat' => 0.875],
            'الجنية عيار 22'     => ['weight' => 8, 'karat' => 0.916],
            'الجنية عيار 24'     => ['weight' => 8, 'karat' => 1],
        ];

        foreach ($bar_weights as $name => $info) {
            if (is_array($info)) {
                // Coin (has weight + karat)
                $weight = $info['weight'];
                $karat = $info['karat'];
                $bar_rates[$name] = round($gram_24 * $karat * $weight, 2);
            } else {
                // Standard bar (pure 24K)
                $bar_rates[$name] = round($gram_24 * $info, 2);
            }
        }

        foreach ($bar_rates as $name => $price) {
            $bullion = Bullion::where('name_ar', $name)->first();
            if ($bullion) {
                $bullion_price = BullionPrice::where('bullion_id', $bullion->id)->where('currency_id', $currency->id)->first();

                if ($bullion_price) {
                    $bar_rates = [];



                    if (round($price, 4) > $bullion_price->price) {
                        $status = 'up';
                    } elseif (round($price, 4) < $bullion_price->price) {
                        $status = 'down';
                    } else {
                        $status = $bullion_price->status_price ?? 'up';
                    }

                    $bullion_price->base_price = round($price, 4);
                    $bullion_price->status_price = $status;
                    $bullion_price->dollar_price = round($price * $USD, 4);

                    $bullion_price->save();
                } else {
                    BullionPrice::create([
                        'bullion_id' => $bullion->id,
                        'currency_id' => $currency->id,
                        'base_price' => round($price, 4),
                        'dollar_price' => round($price * $USD, 4),
                        'status_price' => 'up',
                        'latest_updated' => now(),

                    ]);
                }
            }
        }
    }
}
