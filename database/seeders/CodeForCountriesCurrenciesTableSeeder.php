<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeForCountriesCurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $countries_data = [
            ['country' => 'Egypt', 'code' => 'EG', 'currency' => 'EGP'],
            ['country' => 'United States', 'code' => 'US', 'currency' => 'USD'],
            ['country' => 'Saudi Arabia', 'code' => 'SA', 'currency' => 'SAR'],
            ['country' => 'European Union', 'code' => 'EU', 'currency' => 'EUR'],
            ['country' => 'Emirates', 'code' => 'AE', 'currency' => 'AED'],
            ['country' => 'Kuwait', 'code' => 'KW', 'currency' => 'KWD'],
            ['country' => 'United Kingdom', 'code' => 'GB', 'currency' => 'GBP'],
            ['country' => 'Oman', 'code' => 'OM', 'currency' => 'OMR'],
            ['country' => 'China', 'code' => 'CN', 'currency' => 'CNY'],
            ['country' => 'Qatar', 'code' => 'QA', 'currency' => 'QAR'],
            ['country' => 'Bahrain', 'code' => 'BH', 'currency' => 'BHD'],
            ['country' => 'Jordan', 'code' => 'JO', 'currency' => 'JOD'],
            ['country' => 'Canada', 'code' => 'CA', 'currency' => 'CAD'],
            ['country' => 'Australia', 'code' => 'AU', 'currency' => 'AUD'],
            ['country' => 'Japan', 'code' => 'JP', 'currency' => 'JPY'],
            ['country' => 'Switzerland', 'code' => 'CH', 'currency' => 'CHF'],
            ['country' => 'Sweden', 'code' => 'SE', 'currency' => 'SEK'],
            ['country' => 'Norway', 'code' => 'NO', 'currency' => 'NOK'],
            ['country' => 'Denmark', 'code' => 'DK', 'currency' => 'DKK'],
            ['country' => 'Thailand', 'code' => 'TH', 'currency' => 'THB'],
            ['country' => 'Brazil', 'code' => 'BR', 'currency' => 'BRL'],
            ['country' => 'Russia', 'code' => 'RU', 'currency' => 'RUB'],
            ['country' => 'Czechia', 'code' => 'CZ', 'currency' => 'CZK'],
            ['country' => 'South Africa', 'code' => 'ZA', 'currency' => 'ZAR'],
            ['country' => 'Türkiye', 'code' => 'TR', 'currency' => 'TRY'],
            ['country' => 'Bulgaria', 'code' => 'BG', 'currency' => 'BGN'],
            ['country' => 'Philippines', 'code' => 'PH', 'currency' => 'PHP'],
            ['country' => 'Singapore', 'code' => 'SG', 'currency' => 'SGD'],
            ['country' => 'Malaysia', 'code' => 'MY', 'currency' => 'MYR'],
            ['country' => 'New Zealand', 'code' => 'NZ', 'currency' => 'NZD'],
            ['country' => 'Romania', 'code' => 'RO', 'currency' => 'RON'],
            ['country' => 'Poland', 'code' => 'PL', 'currency' => 'PLN'],
            ['country' => 'Mexico', 'code' => 'MX', 'currency' => 'MXN'],
            ['country' => 'South Korea', 'code' => 'KR', 'currency' => 'KRW'],
            ['country' => 'Iceland', 'code' => 'IS', 'currency' => 'ISK'],
            ['country' => 'India', 'code' => 'IN', 'currency' => 'INR'],
            ['country' => 'Indonesia', 'code' => 'ID', 'currency' => 'IDR'],
            ['country' => 'Hungary', 'code' => 'HU', 'currency' => 'HUF'],
            ['country' => 'Hong Kong', 'code' => 'HK', 'currency' => 'HKD'],
        
            // Additional countries
            ['country' => 'UAE', 'code' => 'AE', 'currency' => 'AED'],
            ['country' => 'Palestine', 'code' => 'PS', 'currency' => 'ILS'],
            ['country' => 'Lebanon', 'code' => 'LB', 'currency' => 'LBP'],
            ['country' => 'Sudan', 'code' => 'SD', 'currency' => 'SDG'],
            ['country' => 'Syria', 'code' => 'SY', 'currency' => 'SYP'],
            ['country' => 'Tunisia', 'code' => 'TN', 'currency' => 'TND'],
            ['country' => 'Morocco', 'code' => 'MA', 'currency' => 'MAD'],
            ['country' => 'Algeria', 'code' => 'DZ', 'currency' => 'DZD'],
            ['country' => 'Yemen', 'code' => 'YE', 'currency' => 'YER'],
            ['country' => 'Libya', 'code' => 'LY', 'currency' => 'LYD'],
            ['country' => 'Iraq', 'code' => 'IQ', 'currency' => 'IQD'],
            ['country' => 'Mauritania', 'code' => 'MR', 'currency' => 'MRU'],
        ];
       

        foreach ($countries_data as $index => $country) {
            
            Country::where('name_en',$country['country'])->update([
                'country_code'=>$country['code'],
                'currency_code'=>$country['currency'],
            ]);
        }
    }
}
