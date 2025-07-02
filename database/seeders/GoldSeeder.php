<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GoldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        $golds = [
            ['name_ar' => 'أونصة ذهب', 'name_en' => 'Gold Ounce', 'icon' => '🪙'],
            ['name_ar' => 'عيار 24', 'name_en' => 'Gold 24K', 'icon' => '🥇'],
            ['name_ar' => 'عيار 22', 'name_en' => 'Gold 22K', 'icon' => '🥇'],
            ['name_ar' => 'عيار 21', 'name_en' => 'Gold 21K', 'icon' => '🥇'],
            ['name_ar' => 'عيار 18', 'name_en' => 'Gold 18K', 'icon' => '🥈'],
            ['name_ar' => 'عيار 14', 'name_en' => 'Gold 14K', 'icon' => '🥈'],
            ['name_ar' => 'عيار 12', 'name_en' => 'Gold 12K', 'icon' => '🥉'],
            ['name_ar' => 'عيار 10', 'name_en' => 'Gold 10K', 'icon' => '🥉'],
            ['name_ar' => 'عيار 9',  'name_en' => 'Gold 9K', 'icon' => '🥉'],
            ['name_ar' => 'عيار 8',  'name_en' => 'Gold 8K', 'icon' => '🥉'],
            ['name_ar' => 'جنيه ذهب', 'name_en' => 'Gold Pound', 'icon' => '🪙'],

        ];



        DB::table('golds')->insert($golds);
    }
}
