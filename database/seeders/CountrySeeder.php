<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $countries_ar = Country::$countries_ar;
        $countries_en = Country::$countries_en;
        $countries_slug = Country::$countries_slug;
        $currency_names_ar = Country::$currency_names_ar;
        $currency_names_en = Country::$currency_names_en;
        // $currency_slug = Country::$currency_slug;
       

        foreach ($countries_ar as $index => $country_ar) {
            DB::table('countries')->insert([
                'name_ar' => $country_ar,
                'name_en' => $countries_en[$index],
                'currency_ar' => $currency_names_ar[$index],
                'currency_en' => $currency_names_en[$index],
                'slug' => $countries_slug[$index],   ///for get data from url
                // 'currency_slug' => $currency_slug[$index],   ///for get data from url
            
            ]);
        }
    
        //
    }
}
