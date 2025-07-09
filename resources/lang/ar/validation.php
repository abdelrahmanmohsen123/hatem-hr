<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other :value.',
    'active_url' => ':attribute يجب أن يكون رابط URL صحيح.',
    'after' => ':attribute يجب أن يكون تاريخ بعد :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخ بعد أو يساوي :date.',
    'alpha' => ':attribute يجب أن يحتوي على حروف فقط.',
    'alpha_dash' => ':attribute يجب أن يحتوي على حروف، أرقام، شرطات وشرطات سفلية فقط.',
    'alpha_num' => ':attribute يجب أن يحتوي على حروف وأرقام فقط.',
    'array' => ':attribute يجب أن يكون مصفوفة.',
    'ascii' => ':attribute يجب أن يحتوي على حروف أو أرقام ASCII فقط.',
    'before' => ':attribute يجب أن يكون تاريخ قبل :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخ قبل أو يساوي :date.',
    'between' => [
        'array' => ':attribute يجب أن يحتوي على :min إلى :max عنصر.',
        'file' => ':attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون بين :min و :max.',
        'string' => ':attribute يجب أن يكون بين :min و :max حرف.',
    ],
    'boolean' => ':attribute يجب أن يكون صحيح أو خطأ.',
    'confirmed' => ':attribute التأكيد غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute يجب أن يكون تاريخ صحيح.',
    'date_equals' => ':attribute يجب أن يكون تاريخ يساوي :date.',
    'date_format' => ':attribute يجب أن يتطابق مع التنسيق :format.',
    'decimal' => ':attribute يجب أن يحتوي على :decimal خانات عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما يكون :other :value.',
    'different' => ':attribute و :other يجب أن يكونا مختلفين.',
    'digits' => ':attribute يجب أن يكون :digits رقم.',
    'digits_between' => ':attribute يجب أن يكون بين :min و :max رقم.',
    'dimensions' => ':attribute الأبعاد غير صالحة.',
    'distinct' => ':attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => ':attribute يجب ألا ينتهي بـ :values.',
    'doesnt_start_with' => ':attribute يجب ألا يبدأ بـ :values.',
    'email' => ':attribute يجب أن يكون بريد إلكتروني صحيح.',
    'ends_with' => ':attribute يجب أن ينتهي بـ :values.',
    'enum' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'exists' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'file' => ':attribute يجب أن يكون ملف.',
    'filled' => ':attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => ':attribute يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'string' => ':attribute يجب أن يكون أكبر من :value حرف.',
    ],
    'gte' => [
        'array' => ':attribute يجب أن يحتوي على :value عنصر أو أكثر.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'string' => ':attribute يجب أن يكون أكبر من أو يساوي :value حرف.',
    ],
    'image' => ':attribute يجب أن تكون صورة (jpeg, png, jpg, gif).',
    'in' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => ':attribute يجب أن يكون عدد صحيح.',
    'ip' => ':attribute يجب أن يكون عنوان IP صحيح.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صحيح.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صحيح.',
    'json' => ':attribute يجب أن يكون نص JSON صحيح.',
    'lt' => [
        'array' => ':attribute يجب أن يحتوي على أقل من :value عنصر.',
        'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'string' => ':attribute يجب أن يكون أقل من :value حرف.',
    ],
    'lte' => [
        'array' => ':attribute يجب أن يحتوي على :value عنصر أو أقل.',
        'file' => ':attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أقل من أو يساوي :value.',
        'string' => ':attribute يجب أن يكون أقل من أو يساوي :value حرف.',
    ],
    'mac_address' => ':attribute يجب أن يكون عنوان MAC صحيح.',
    'max' => [
        'array' => ':attribute يجب أن يحتوي على الأكثر :max عنصر.',
        'file' => ':attribute يجب أن يكون على الأكثر :max كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون على الأكثر :max.',
        'string' => ':attribute يجب أن يكون على الأكثر :max حرف.',
    ],
    'max_digits' => ':attribute يجب ألا يحتوي على أكثر من :max أرقام.',
    'mimes' => ':attribute يجب أن يكون ملف من النوع: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملف من النوع: :values.',
    'min' => [
        'array' => ':attribute يجب أن يحتوي على الأقل :min عنصر.',
        'file' => ':attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون على الأقل :min.',
        'string' => ':attribute يجب أن يكون على الأقل :min حرف.',
    ],
    'min_digits' => ':attribute يجب أن يحتوي على الأقل :min أرقام.',
    'missing' => ':attribute يجب أن يكون مفقود.',
    'missing_if' => ':attribute يجب أن يكون مفقود عندما يكون :other :value.',
    'missing_unless' => ':attribute يجب أن يكون مفقود إلا إذا كان :other :value.',
    'missing_with' => ':attribute يجب أن يكون مفقود عندما يكون :values موجود.',
    'missing_with_all' => ':attribute يجب أن يكون مفقود عندما تكون :values موجودة.',
    'multiple_of' => ':attribute يجب أن يكون مضاعف لـ :value.',
    'not_in' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'not_regex' => 'تنسيق :attribute غير صالح.',
    'numeric' => ':attribute يجب أن يكون رقم.',
    'password' => [
        'required' => 'حقل كلمة المرور مطلوب.',
        'string' => 'يجب أن تكون كلمة المرور نصًا.',
        'min' => 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.',
        'max' => 'يجب ألا تزيد كلمة المرور عن 16 حرفًا.',
        'regex' => 'يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل، وحرف صغير واحد، ورقم واحد، وحرف خاص واحد.',
        'letters' => 'يجب أن يحتوي حقل :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي حقل :attribute على حرف كبير واحد على الأقل وحرف صغير واحد.',
        'numbers' => 'يجب أن يحتوي حقل :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي حقل :attribute على رمز واحد على الأقل.',
        'uncompromised' => 'ظهرت كلمة المرور المعطاة في تسريب بيانات. يرجى اختيار كلمة مرور مختلفة.',
    ],
    'present' => ':attribute يجب أن يكون موجود.',
    'prohibited' => ':attribute غير مسموح.',
    'prohibited_if' => ':attribute غير مسموح عندما يكون :other :value.',
    'prohibited_unless' => ':attribute غير مسموح إلا إذا كان :other في :values.',
    'prohibits' => ':attribute يمنع :other من التواجد.',
    'regex' => 'تنسيق :attribute غير صالح.',
    'required' => ':attribute مطلوب.',
    'required_array_keys' => ':attribute يجب أن يحتوي على مدخلات لـ :values.',
    'required_if' => ':attribute مطلوب عندما يكون :other :value.',
    'required_if_accepted' => ':attribute مطلوب عندما يتم قبول :other.',
    'required_unless' => ':attribute مطلوب إلا إذا كان :other في :values.',
    'required_with' => ':attribute مطلوب عندما يكون :values موجود.',
    'required_with_all' => ':attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => ':attribute مطلوب عندما لا يكون :values موجود.',
    'required_without_all' => ':attribute مطلوب عندما لا تكون أي من :values موجودة.',
    'same' => ':attribute و :other يجب أن يكونا متطابقين.',
    'size' => [
        'array' => ':attribute يجب أن يحتوي على :size عنصر.',
        'file' => ':attribute يجب أن يكون :size كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون :size.',
        'string' => ':attribute يجب أن يكون :size حرف.',
    ],
    'starts_with' => ':attribute يجب أن يبدأ بـ :values.',
    'string' => ':attribute يجب أن يكون نص.',
    'timezone' => ':attribute يجب أن يكون نطاق زمني صحيح.',
    'unique' => 'القيمة لـ :attribute موجودة من قبل.',
    'uploaded' => 'فشل تحميل :attribute.',
    'uppercase' => ':attribute يجب أن يكون بحروف كبيرة.',
    'url' => ':attribute يجب أن يكون رابط URL صحيح.',
    'ulid' => ':attribute يجب أن يكون ULID صحيح.',
    'uuid' => ':attribute يجب أن يكون UUID صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'user_id' => [
            'string' => 'يجب أن تكون قيمة معينة للمستخدم.',
        ],
        'provider_id' => [
            'string' => 'يجب أن تكون قيمة معينة لمقدم الخدمة.',
        ],
        'datetime' => [
            'unexpected_keys' => 'تم العثور على مفاتيح غير متوقعة في البيانات :keys. يرجى التحقق من المدخلات وإعادة المحاولة.',        ],
            'birth_date' => [
                'required' => 'تاريخ الميلاد مطلوب.',
                'date' => 'تاريخ الميلاد ليس تاريخًا صالحًا.',
                'before' => 'يجب أن يكون تاريخ الميلاد قبل اليوم.',
                'before_or_equal' => 'يجب ان لا يقل عمرك عن 15 عام'
            ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'icon' => 'الصورة',
        'icon_path' => 'الصورة',
        'user_id' => 'المستخدم',
        'provider_id' => 'مقدم الخدمة',
        'service_id' => 'الخدمة',
        'vehicle_id' => 'المركبة',
        'title' => 'العنوان',
        'name_ar' => 'الاسم بالعربية',
        'name_en' => 'الاسم بالإنجليزية',
        'name' => 'الاسم',
        'image_path' => 'الصورة',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'order' => 'الترتيب',
        'phone' => 'رقم الهاتف',
        'country_id' => 'الدولة',
        'city_id' => 'المدينة',
        'package_id' => 'الباقة',
        'birth_date' => 'تاريخ الميلاد',
        'from' => 'من',
        'to' => 'إلى',
        'documents.*.document_id' => 'المستند',
        'categories.*' => 'التصنيفات',
        'document_id' => 'المستند',
        'amount'=>'المبلغ',
        'deservation'=>'الاستحقاق',
        'rating' => 'التقييم',
        'review' => 'المراجعة',
        'amount' => 'المبلغ',
        'invoice_image' => 'صورة الفاتورة',



        'android_version' => 'نسخة الأندرويد',
        'ios_version' => 'نسخة iOS',
        'firebase_api_access_key' => 'مفتاح وصول Firebase API',
        'app_active' => 'التطبيق نشط',
        'minimum_delivery_fee' => 'الحد الأدنى لرسوم التوصيل',
        'maximum_delivery_fee' => 'الحد الأقصى لرسوم التوصيل',
        'price_per_kilo' => 'السعر لكل كيلو',
        'max_bid_additional_price' => 'أقصى سعر إضافي للمزايدة',
        'courier_order_commission_percentage' => 'نسبة عمولة طلب التوصيل',
        'courier_dues_limit' => 'حد مستحقات التوصيل',
        'min_withdrawal_amount' => 'الحد الأدنى لسحب المبلغ',
        'service_fee' => 'رسوم الخدمة',
        'whatsapp' => 'واتساب',
        'instagram' => 'إنستغرام',
        'facebook' => 'فيسبوك',
        'youtube' => 'يوتيوب',
        'tiktok' => 'تيك توك',
        'twitter' => 'تويتر',
        'sending_notification_status' => 'حالة إرسال الإشعارات',
    ],

    'values' => [
        'birth_date' => [
            'yesterday' => 'أمس',
            'now' => 'الآن',
            'today' => 'اليوم',
            'tomorrow' => 'غداً',
        ],
    ]

];
