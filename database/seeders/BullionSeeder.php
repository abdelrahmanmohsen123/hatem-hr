<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BullionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          $bars = [
            ['ar' => 'سبيكة 1 جرام',         'en' => '1 Gram Bar'],
            ['ar' => 'سبيكة 2.5 جرام',       'en' => '2.5 Gram Bar'],
            ['ar' => 'سبيكة 5 جرام',         'en' => '5 Gram Bar'],
            ['ar' => 'سبيكة 10 جرام',        'en' => '10 Gram Bar'],
            ['ar' => 'سبيكة 20 جرام',        'en' => '20 Gram Bar'],
            ['ar' => 'سبيكة 50 جرام',        'en' => '50 Gram Bar'],
            ['ar' => 'سبيكة 100 جرام',       'en' => '100 Gram Bar'],
            ['ar' => 'سبيكة 250 جرام',       'en' => '250 Gram Bar' ],
            ['ar' => 'سبيكة 500 جرام',       'en' => '500 Gram Bar'],
            ['ar' => 'سبيكة 1 كيلو',         'en' => '1 Kilogram Bar'],
            ['ar' => 'سبيكة 1 أونصة',        'en' => '1 Ounce Bar'],
            ['ar' => 'سبيكة نصف أونصة',      'en' => 'Half Ounce Bar' ],
            ['ar' => 'سبيكة التولة',         'en' => 'Tola Bar'],
            ['ar' => 'سبيكة أوقية',          'en' => 'Oqiya Bar' ],
            ['ar' => 'الجنية عيار 21',       'en' => '21K Gold Coin' ],
            ['ar' => 'الجنية عيار 22',       'en' => '22K Gold Coin' ],
            ['ar' => 'الجنية عيار 24',       'en' => '24K Gold Coin' ],
        ];

       
            # code...
            foreach ($bars as $bar) {
                DB::table('Bullions')->insert([
                    'name_ar' => $bar['ar'],
                    'name_en' => $bar['en'],
                    'icon' => null,
                    'status' => true,
                  
                ]);
        }
    }
}
