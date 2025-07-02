<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $currencies = [
            ['name_en' => 'Egyptian Pound', 'name_ar' => 'جنيه مصري', 'code' => 'EGP', 'country' => 'Egypt', 'symbol' => 'E£', 'icon' => '🇪🇬'],
            ['name_en' => 'US Dollar', 'name_ar' => 'دولار أمريكي', 'code' => 'USD', 'country' => 'United States', 'symbol' => '$', 'icon' => '🇺🇸'],
            ['name_en' => 'Saudi Riyal', 'name_ar' => 'ريال سعودي', 'code' => 'SAR', 'country' => 'Saudi Arabia', 'symbol' => 'ر.س', 'icon' => '🇸🇦'],
            ['name_en' => 'Euro', 'name_ar' => 'يورو', 'code' => 'EUR', 'country' => 'European Union', 'symbol' => '€', 'icon' => '🇪🇺'],
            ['name_en' => 'UAE Dirham', 'name_ar' => 'درهم إماراتي', 'code' => 'AED', 'country' => 'Emirates', 'symbol' => 'د.إ', 'icon' => '🇦🇪'],
            ['name_en' => 'Kuwaiti Dinar', 'name_ar' => 'دينار كويتي', 'code' => 'KWD', 'country' => 'Kuwait', 'symbol' => 'د.ك', 'icon' => '🇰🇼'],
            ['name_en' => 'British Pound', 'name_ar' => 'جنيه إسترليني', 'code' => 'GBP', 'country' => 'United Kingdom', 'symbol' => '£', 'icon' => '🇬🇧'],
            ['name_en' => 'Omani Rial', 'name_ar' => 'ريال عماني', 'code' => 'OMR', 'country' => 'Oman', 'symbol' => 'ر.ع', 'icon' => '🇴🇲'],
            ['name_en' => 'Chinese Yuan', 'name_ar' => 'يوان صيني', 'code' => 'CNY', 'country' => 'China', 'symbol' => '¥', 'icon' => '🇨🇳'],
            ['name_en' => 'Qatari Riyal', 'name_ar' => 'ريال قطري', 'code' => 'QAR', 'country' => 'Qatar', 'symbol' => 'ر.ق', 'icon' => '🇶🇦'],
            ['name_en' => 'Bahraini Dinar', 'name_ar' => 'دينار بحريني', 'code' => 'BHD', 'country' => 'Bahrain', 'symbol' => 'د.ب', 'icon' => '🇧🇭'],
            ['name_en' => 'Jordanian Dinar', 'name_ar' => 'دينار أردني', 'code' => 'JOD', 'country' => 'Jordan', 'symbol' => 'د.ا', 'icon' => '🇯🇴'],
            ['name_en' => 'Canadian Dollar', 'name_ar' => 'دولار كندي', 'code' => 'CAD', 'country' => 'Canada', 'symbol' => '$', 'icon' => '🇨🇦'],
            ['name_en' => 'Australian Dollar', 'name_ar' => 'دولار أسترالي', 'code' => 'AUD', 'country' => 'Australia', 'symbol' => '$', 'icon' => '🇦🇺'],
            ['name_en' => 'Japanese Yen', 'name_ar' => 'ين ياباني', 'code' => 'JPY', 'country' => 'Japan', 'symbol' => '¥', 'icon' => '🇯🇵'],
            ['name_en' => 'Swiss Franc', 'name_ar' => 'فرنك سويسري', 'code' => 'CHF', 'country' => 'Switzerland', 'symbol' => 'Fr', 'icon' => '🇨🇭'],
            ['name_en' => 'Swedish Krona', 'name_ar' => 'كرونا سويدية', 'code' => 'SEK', 'country' => 'Sweden', 'symbol' => 'kr', 'icon' => '🇸🇪'],
            ['name_en' => 'Norwegian Krone', 'name_ar' => 'كرونة نرويجية', 'code' => 'NOK', 'country' => 'Norway', 'symbol' => 'kr', 'icon' => '🇳🇴'],
            ['name_en' => 'Danish Krone', 'name_ar' => 'كرونة دنماركية', 'code' => 'DKK', 'country' => 'Denmark', 'symbol' => 'kr', 'icon' => '🇩🇰'],
            ['name_en' => 'Thai Baht', 'name_ar' => 'بات تايلاندي', 'code' => 'THB', 'country' => 'Thailand', 'symbol' => '฿', 'icon' => '🇹🇭'],
            ['name_en' => 'Brazilian Real', 'name_ar' => 'ريال برازيلي', 'code' => 'BRL', 'country' => 'Brazil', 'symbol' => 'R$', 'icon' => '🇧🇷'],
            ['name_en' => 'Russian Ruble', 'name_ar' => 'روبل روسي', 'code' => 'RUB', 'country' => 'Russia', 'symbol' => '₽', 'icon' => '🇷🇺'],
            ['name_en' => 'Czech Koruna', 'name_ar' => 'كرونة تشيكية', 'code' => 'CZK', 'country' => 'Czechia', 'symbol' => 'Kč', 'icon' => '🇨🇿'],
            ['name_en' => 'South African Rand', 'name_ar' => 'راند جنوب أفريقي', 'code' => 'ZAR', 'country' => 'South Africa', 'symbol' => 'R', 'icon' => '🇿🇦'],
            ['name_en' => 'Turkish Lira', 'name_ar' => 'ليرة تركية', 'code' => 'TRY', 'country' => 'Türkiye', 'symbol' => '₺', 'icon' => '🇹🇷'],
            ['name_en' => 'Bulgarian Lev', 'name_ar' => 'ليف بلغاري', 'code' => 'BGN', 'country' => 'Bulgaria', 'symbol' => 'лв', 'icon' => '🇧🇬'],
            ['name_en' => 'Philippine Peso', 'name_ar' => 'بيزو فلبيني', 'code' => 'PHP', 'country' => 'Philippines', 'symbol' => '₱', 'icon' => '🇵🇭'],
            ['name_en' => 'Singapore Dollar', 'name_ar' => 'دولار سنغافوري', 'code' => 'SGD', 'country' => 'Singapore', 'symbol' => '$', 'icon' => '🇸🇬'],
            ['name_en' => 'Malaysian Ringgit', 'name_ar' => 'رينغيت ماليزي', 'code' => 'MYR', 'country' => 'Malaysia', 'symbol' => 'RM', 'icon' => '🇲🇾'],
            ['name_en' => 'New Zealand Dollar', 'name_ar' => 'دولار نيوزيلندي', 'code' => 'NZD', 'country' => 'New Zealand', 'symbol' => '$', 'icon' => '🇳🇿'],
            ['name_en' => 'Romanian Leu', 'name_ar' => 'ليو روماني', 'code' => 'RON', 'country' => 'Romania', 'symbol' => 'lei', 'icon' => '🇷🇴'],
            ['name_en' => 'Polish Zloty', 'name_ar' => 'زلوتي بولندي', 'code' => 'PLN', 'country' => 'Poland', 'symbol' => 'zł', 'icon' => '🇵🇱'],
            ['name_en' => 'Mexican Peso', 'name_ar' => 'بيزو مكسيكي', 'code' => 'MXN', 'country' => 'Mexico', 'symbol' => '$', 'icon' => '🇲🇽'],
            ['name_en' => 'South Korean Won', 'name_ar' => 'وون كوري جنوبي', 'code' => 'KRW', 'country' => 'South Korea', 'symbol' => '₩', 'icon' => '🇰🇷'],
            ['name_en' => 'Icelandic Krona', 'name_ar' => 'كرونا آيسلندية', 'code' => 'ISK', 'country' => 'Iceland', 'symbol' => 'kr', 'icon' => '🇮🇸'],
            ['name_en' => 'Indian Rupee', 'name_ar' => 'روبية هندية', 'code' => 'INR', 'country' => 'India', 'symbol' => '₹', 'icon' => '🇮🇳'],
            ['name_en' => 'Indonesian Rupiah', 'name_ar' => 'روبية إندونيسية', 'code' => 'IDR', 'country' => 'Indonesia', 'symbol' => 'Rp', 'icon' => '🇮🇩'],
            ['name_en' => 'Hungarian Forint', 'name_ar' => 'فورنت مجري', 'code' => 'HUF', 'country' => 'Hungary', 'symbol' => 'Ft', 'icon' => '🇭🇺'],
            ['name_en' => 'Hong Kong Dollar', 'name_ar' => 'دولار هونج كونج', 'code' => 'HKD', 'country' => 'Hong Kong', 'symbol' => '$', 'icon' => '🇭🇰'],
            ['name_en' => 'Pakistani Rupee', 'name_ar' => 'روبية باكستانية', 'code' => 'PKR', 'country' => 'Pakistan', 'symbol' => '₨', 'icon' => '🇵🇰'],
            ['name_en' => 'Bangladeshi Taka', 'name_ar' => 'تاكا بنغلاديشي', 'code' => 'BDT', 'country' => 'Bangladesh', 'symbol' => '৳', 'icon' => '🇧🇩'],
            ['name_en' => 'Iraqi Dinar', 'name_ar' => 'دينار عراقي', 'code' => 'IQD', 'country' => 'Iraq', 'symbol' => 'ع.د', 'icon' => '🇮🇶'],
            ['name_en' => 'Tunisian Dinar', 'name_ar' => 'دينار تونسي', 'code' => 'TND', 'country' => 'Tunisia', 'symbol' => 'د.ت', 'icon' => '🇹🇳'],
            ['name_en' => 'Moroccan Dirham', 'name_ar' => 'درهم مغربي', 'code' => 'MAD', 'country' => 'Morocco', 'symbol' => 'د.م.', 'icon' => '🇲🇦'],
            ['name_en' => 'Libyan Dinar', 'name_ar' => 'دينار ليبي', 'code' => 'LYD', 'country' => 'Libya', 'symbol' => 'ل.د', 'icon' => '🇱🇾'],
            ['name_en' => 'Algerian Dinar', 'name_ar' => 'دينار جزائري', 'code' => 'DZD', 'country' => 'Algeria', 'symbol' => 'د.ج', 'icon' => '🇩🇿'],
            ['name_en' => 'Sudanese Pound', 'name_ar' => 'جنيه سوداني', 'code' => 'SDG', 'country' => 'Sudan', 'symbol' => 'ج.س.', 'icon' => '🇸🇩'],
        ];

        foreach ($currencies as $currency) {
            $country = Country::where('name_en', $currency['country'])->first();

            DB::table('currencies')->insert([
                'name_en' => $currency['name_en'],
                'name_ar' => $currency['name_ar'],
                'symbol'  => $currency['symbol'],
                'code'    => $currency['code'],
                'icon'    => $currency['icon'],
                'country_id' => $country?->id,
             
            ]);
        }
    }
}
