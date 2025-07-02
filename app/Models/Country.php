<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;
     protected $guarded = [];

     public static $countries_ar = [
        'مصر',
        'الولايات المتحدة',
        'السعودية',
        'الاتحاد الأوروبي',
        'الإمارات',
        'الكويت',
        'المملكة المتحدة',
        'عمان',
        'الصين',
        'قطر',
        'البحرين',
        'اﻷردن',
        'كندا',
        'استراليا',
        'اليابان',
        'سويسرا',
        'السويد',
        'النرويج',
        'الدنمارك',
        'تايلاند',
        'البرازيل',
        'روسيا',
        'التشيك',
        'جنوب أفريقيا',
        'تركيا',
        'بلغاريا',
        'فيلبين',
        'سنغافورة',
        'ماليزيا',
        'نيوزيلندا',
        'رومانيا',
        'بولندا',
        'المكسيك',
        'كوريا الجنوبية',
        'أيسلندا',
        'الهند',
        'إندونيسيا',
        'هنغاريا',
        'هونج كونج',
       
    ];


    public static $countries_en = [
        'Egypt',
        'United States',
        'Saudi Arabia',
        'European Union',
        'Emirates',
        'Kuwait',
        'United Kingdom',
        'Oman',
        'China',
        'Qatar',
        'Bahrain',
        'Jordan',
        'Canada',
        'Australia',
        'Japan',
        'Switzerland',
        'Sweden',
        'Norway',
        'Denmark',
        'Thailand',
        'Brazil',
        'Russia',
        'Czechia',
        'South Africa',
        'Türkiye',
        'Bulgaria',
        'Philippines',
        'Singapore',
        'Malaysia',
        'New Zealand',
        'Romania',
        'Poland',
        'Mexico',
        'South Korea',
        'Iceland',
        'India',
        'Indonesia',
        'Hungary',
        'Hong Kong',

        

        
    ];


    public static $countries_slug = [
        'egypt',
        'united-states',
        'saudi-arabia',
        'euro-region',
        'uae',
        'kuwait',
        'united-kingdom',
        'oman',
        'china',
        'qatar',
        'bahrain',
        'jordan',
        'canada',
        'australia',
        'japan',
        'switzerland',
        'sweden',
        'norway',
        'denmark',
        'thailand',
        'brazil',
        'russia',
        'czechia',
        'south-africa',
        't%C3%BCrkiye',
        'bulgaria',
        'philippines',
        'singapore',
        'malaysia',
        'new-zealand',
        'romania',
        'poland',
        'mexico',
        'south-korea',
        'iceland',
        'india',
        'indonesia',
        'hungary',
        'hong-kong',
    ];

    public static $currency_names_ar = [
        'جنيه مصري', 'دولار أمريكي', 'ريال سعودي', 'يورو', 'درهم إماراتي', 
        'دينار كويتي', 'جنيه إسترليني', 'ريال عماني', 'يوان صيني', 'ريال قطري', 
        'دينار بحريني', 'دينار أردني', 'دولار كندي', 'دولار أسترالي', 'ين ياباني', 'فرنك سويسري', 
        'كرونا سويدية', 'كرونة نرويجية', 'كرونة دنماركية', 'بات تايلاندي', 'ريال برازيلي', 
        'روبل روسي', 'كرونة تشيكية', 'راند جنوب أفريقي', 'ليرة تركية', 'ليف بلغاري', 'بيزو فلبيني', 
        'دولار سنغافوري', 'رينغيت ماليزي', 'دولار نيوزيلندي', 'ليو روماني', 'زلوتي بولندي', 'بيزو مكسيكي', 
        'وون كوري جنوبي', 'كرونا آيسلندية', 'روبية هندية', 'روبية إندونيسية', 'فورنت مجري', 'دولار هونج كونج'
    ];

    public static $currency_slug = [
        'egp',
        'usd',
        'sar',
        'eur',
        'aed',
        'kwd',
        'gbp',
        'omr',
        'cny',
        'qar',
        'bhd',
        'jod',
        'cad',
        'aud',
        'jpy',
        'chf',
        'sek',
        'nok',
        'dkk',
        'thb',
        'brl',
        'rub',
        'czk',
        'zar',
        'try',
        'bgn',
        'php',
        'sgd',
        'myr',
        'nzd',
        'ron',
        'pln',
        'mxn',
        'krw',
        'isk',
        'inr',
        'idr',
        'huf',
        'hkd'
    ];
    
    public static $currency_names_en = [
        'Egyptian Pound', 'US Dollar', 'Saudi Riyal', 'Euro', 'UAE Dirham', 'Kuwaiti Dinar', 'British Pound', 
        'Omani Rial', 'Chinese Yuan', 'Qatari Riyal', 'Bahraini Dinar', 'Jordanian Dinar', 'Canadian Dollar', 
        'Australian Dollar', 'Japanese Yen', 'Swiss Franc', 'Swedish Krona', 'Norwegian Krone', 'Danish Krone', 
        'Thai Baht', 'Brazilian Real', 'Russian Ruble', 'Czech Koruna', 'South African Rand', 'Turkish Lira', 
        'Bulgarian Lev', 'Philippine Peso', 'Singapore Dollar', 'Malaysian Ringgit', 'New Zealand Dollar', 
        'Romanian Leu', 'Polish Zloty', 'Mexican Peso', 'South Korean Won', 'Icelandic Krona', 'Indian Rupee', 
        'Indonesian Rupiah', 'Hungarian Forint', 'Hong Kong Dollar'
    ];

}
