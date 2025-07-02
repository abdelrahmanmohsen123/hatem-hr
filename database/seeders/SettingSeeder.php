<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Setting::create([
            'whatsapp' => '01000000000',
            'instagram' => 'https://www.instagram.com/yourpage',
            'facebook' => 'https://www.facebook.com/yourpage',
            'youtube' => 'https://www.youtube.com/yourpage',
            'tiktok' => 'https://www.tiktok.com/yourpage',
            'android_version' => '1.0.0',
            'ios_version' => '1.0.0',
            'force_update_android_version' => 0,
            'force_update_ios_version' => 0,
            'app_active' => 1,
        ]);
    }
}
