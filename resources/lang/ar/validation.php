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

    'accepted'        => 'يجب قبول :attribute.',
    'active_url'      => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after'           => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'  => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'           => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash'      => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num'       => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array'           => 'يجب أن يكون :attribute ًمصفوفة.',
    'before'          => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'         => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'        => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed'      => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date'           => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'    => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format'    => 'لا يتوافق :attribute مع الشكل :format.',
    'different'      => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits'         => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions'     => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'       => 'للحقل :attribute قيمة مُكرّرة.',
    'email'          => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'ends_with'      => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values',
    'exists'         => 'القيمة المحددة :attribute غير موجودة.',
    'file'           => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'         => ':attribute إجباري.',
    'gt'             => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image'    => 'يجب أن يكون :attribute صورةً.',
    'in'       => ':attribute غير موجود.',
    'in_array' => ':attribute غير موجود في :other.',
    'integer'  => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'       => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4'     => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'     => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'     => 'يجب أن يكون :attribute نصًا من نوع JSON.',
    'lt'       => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'     => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'       => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => 'العنصر :attribute غير صحيح.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب تقديم :attribute.',
    'regex'                => 'صيغة :attribute .غير صحيحة.',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string'      => 'يجب أن يكون :attribute نصًا.',
    'timezone'    => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique'      => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded'    => 'فشل في تحميل الـ :attribute.',
    'url'         => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid'        => ':attribute يجب أن يكون بصيغة UUID سليمة.',

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
        'name_ar' => [
            'required' => 'الإسم بالعربية مطلوب',
        ],
        'name_en' => [
            'required' => 'الإسم بالإنجليزية مطلوب',
        ],
        'image' => [
            'required' => 'الصورة مطلوبة',
            'image' => 'يجب أن يكون نوع الملف صورة',
            'max' => 'يجب أل يتجاوز حجم الصورة ',
            'mimes' => 'يجب أن يكون إمتداد الصورة ',
        ],
        'description_ar' => [
            'required' => 'الوصف بالعربية مطلوب',
        ],
        'description_en' => [
            'required' => 'الوصف بالإنجليزية مطلوب',
        ],
        'contents_ar' => [
            'required' => 'المحتوى بالعربية مطلوب',
        ],
        'contents_en' => [
            'required' => 'المحتوى بالإنجليزية مطلوب',
        ],
        'benefits_ar' => [
            'required' => 'الفوائد بالعربية مطلوب',
        ],
        'benefits_en' => [
            'required' => 'الفوائد بالإنجليزية مطلوب',
        ],
        'bag_category_id' => [
            'required' => 'قسم الحقيبة التعليمية مطلوب',
        ],
        'price' => [
            'required' => 'شعر الحقيبة التعليمية مطلوب',
        ],
        'image' => [
            'image' => 'صورة الحقيبة التعليمية يجب أن تكون صورة صحيحة',
            'max' => 'صورة الحقيبة التعليمية ﻻ يجب أن يتجاوز حجمها ',
            'mimes' => 'صورة الحقيبة التعليمية يجب أن تكون من أمتداد ',
        ],
        'poster' => [
            'image' => 'صورة الغلاف الخاص بالفيديو التعريفى التعليمية يجب أن يكون صورة صحيحة',
            'max' => 'صورة الغلاف الخاص بالفيديو التعريفى التعليمية ﻻ يجب أن يتجاوز حجمها ',
            'mimes' => 'صورة الغلاف الخاص بالفيديو التعريفى التعليمية يجب أن يكون من أمتداد ',
        ],
        'video' => [
            'mimetypes' => 'الفيديو التعريفى بالحقيبة التعليمية يجب أن يكون صيغة فيديو صحيح',
        ],
        'documents' => [
            'array' => 'يجب أن ترفع ملف أو أكثر للحقيبة التعليمية',
            'required_without_all' => 'الملفات التعليمية مطلوبة فى حالة عدم رفع صور أو فيديوهات تعليمية',
        ],
        'images' => [
            'array' => 'يجل أن ترفع صورة أو أكثر للحقيبة التعليمية',
            'required_without_all' => 'الصور التعليمية مطلوبة فى حالة عدم رفع ملفات أو فيديوهات تعليمية',
        ],
        'videos' => [
            'array' => 'يجل أن ترفع فيديو أو أكثر للحقيبة التعليمية',
            'required_without_all' => 'الفيديوهات التعليمية مطلوبة فى حالة عدم رفع ملفات أو صور تعليمية',
        ],
        'carts' => [
            'array' => 'يمكنك إضافة حقيبة أو أكثر إلى عربة التسوق',
            'required' => 'عربة التسوق مطلوبة',
        ],
        'name' => [
            'required' => 'الإسم مطلوب',
        ],
        'email' => [
            'required' => 'البريد الإلكترونى مطلوب',
            'email' => 'البريد الإلكترونى يجب أن يكون بصيغة صحيحة',
            'unique' => 'البريد الإلكترونى مستخدم من قبل',
        ],
        'phone_main' => [
            'required' => 'الجوال مطلوب',
            'unique' => 'الجوال مستخدم من قبل',
            'required_if' => 'الجوال مطلوب',
        ],
        'lat' => [
            'required' => 'الموقع الجغرافى مطلوب',
            'required_if' => 'الموقع الجغرافى مطلوب',
        ],
        'long' => [
            'required' => 'الموقع الجغرافى مطلوب',
            'required_if' => 'الموقع الجغرافى مطلوب',
        ],
        'address' => [
            'required' => 'الموقع الجغرافى مطلوب',
            'required_if' => 'الموقع الجغرافى مطلوب',
        ],
        'job_id' => [
            'required' => 'الوظيفة المقدم إليها مطاولة',
        ],
        'exper_years' => [
            'required' => 'عدد سنوات الخبرة مطلوب',
            'required_if' => 'عدد سنوات الخبرة مطلوب',
        ],
        'salary' => [
            'required' => 'الراتب المتوقع مطلوب',
            'required_if' => 'الراتب المتوقع مطلوب',
        ],
        'cv' => [
            'mimetypes' => 'ملف السيرة الذاتية يجب أن يكون من نوع ',
            'max' => 'ملف السيرة الذاتية يجب أن ﻻ يتجاوز حجمة ',
            'required_if' => 'السيرة الذاتية مطلوبة',
        ],
        'work_hours' => [
            'required' => 'عدد ساعات العمل مطلوب',
        ],
        'required_number' => [
            'required' => 'عدد المتقدمين مطلوب',
        ],
        'free_places' => [
            'required' => 'عدد الأماكن الشاغره مطلوب',
        ],
        'required_age' => [
            'required' => 'العمر المطلوب للوظيفة مطلوب',
        ],
        'specialization_id' => [
            'required' => 'التخصص مطلوب',
        ],
        'other_specialization' => [
            'required_if' => 'التخصص الآخر مطلوب',
        ],
        'address_id' => [
            'required' => 'عنوان الشحن مطلوب',
        ],
        'edu_type_id' => 
        [
            'required' => ' نوع الدراسة مطلوب',
            'required_if' => 'نوع الدراسة مطلوب',
        ],
        'other_edu_type' => 
        [
            'required_if' => 'نوع دراسة الآخر مطلوب',
        ],
        'salary_month' => [
            'required' => 'الراتب الشهرى مطلوب',
        ],
        'title_ar' => [
            'required' => 'العنوان بالعربية مطلوب',
        ],
        'title_en' => [
            'required' => 'العنوان بالإنجليزية مطلوب',
        ],
        'body_ar' => [
            'required' => 'النص بالعربية مطلوب',
        ],
        'body_en' => [
            'required' => 'النص بالإنجليزية مطلوب',
        ],
        'short_description_ar' => [
            'required' => 'الوصف المختصر بالعربية مطلوب',
            'max' => 'ﻻ يجب أن يتجاوز طول الوصف القصير 190 حرفاً',
        ],
        'short_description_en' => [
            'required' => 'الوصف المختصر بالإنجليزية مطلوب',
            'max' => 'ﻻ يجب أن يتجاوز طول الوصف القصير 190 حرفاً',
        ],
        'full_description_ar' => [
            'required' => 'الوصف الكامل بالعربية مطلوب',
        ],
        'full_description_en' => [
            'required' => 'الوصف الكامل بالإنجليزية مطلوب',
        ],
        'vision_title_ar' => [
            'required_if' => ' عنوان الرؤية بالعربية مطلوبة',
        ],
        'vision_title_en' => [
            'required_if' => ' عنوان الرؤية بالإنجليزية مطلوب',
        ],
        'vision_text_ar' => [
            'required_if' => 'نص الرؤية بالعربية مطلوب',
        ],
        'vision_text_en' => [
            'required_if' => 'نص الرؤية بالإنجليزية مطلوب',
        ],
        'message_title_ar' => [
            'required_if' => 'عنوان الرسالة بالعربية مطلوب',
        ],
        'message_title_en' => [
            'required_if' => 'عنوان الرسالة بالإنجليزية مطلوب',
        ],
        'message_text_ar' => [
            'required_if' => 'نص الرسالة بالعربية مطلوب',
        ],
        'message_text_ar' => [
            'required_if' => 'نص الرسالة بالإنجليزية مطلوب',
        ],
        'stage_id' => [
            'required' => 'المرحلة الدراسية مطلوبة',
            'required_if' => 'المرحلة الدراسية مطلوبة',
        ],
        'edu_level_id' => [
            'required' => 'المستوى التعليمى مطلوب',
            'required_if' => 'المستوى التعليمى مطلوب',
        ],
        'material_ids' => [
            'required' => 'المواد التعليمية مطلوبة',
        ],
        'nationality_id' => [
            'required' => 'الجنسية مطلوبة',
        ],
        'teaching_lat' => [
            'required' => 'عنوان التدريس مطلوب',
            'required_if' => 'عنوان التدريس مطلوب',
        ],
        'teaching_long' => [
            'required' => 'عنوان التدريس مطلوب',
            'required_if' => 'عنوان التدريس مطلوب',
        ],
        'teaching_address' => [
            'required' => 'عنوان التدريس مطلوب',
            'required_if' => 'عنوان التدريس مطلوب',
        ],
        'other_stage' => [
            'required_if' => 'المرحلة التعليمية الآخرى مطلوبة',
        ],
        'other_edu_level' => [
            'required_if' => 'المستوى التعليمى لاآخر مطلوب',
        ],
        'bio_ar' => [
            'required_if' => 'النبذه المختصرة بالعربية مطلوبة',
        ],
        'bio_en' => [
            'required_if' => 'النبذة المختصرة بالإنجليزية مطلوبة',
        ],
        'teaching_method' => [
            'required_if' => 'طريقة التعليم مطلوبة',
        ],
        '' => [],
        '' => [],
        
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'الاسم',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'first_name'            => 'الاسم الأول',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'عنوان السكن',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'العنوان',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'name_ar'               => 'الإسم بالعربية',
        'name_en'               => 'الإسم بالإنجليزية',
        'image' => 'الصورة',
        'description_ar' => 'الوصف  بالعربية',
        'description_en' => 'الوصف بالإنجليزية',
        'contents_ar' => 'المحتوى بالعربية',
        'contents_en' => 'المحتوى بالإنجليزية',
        'benefits_ar' => 'الفوائد بالعربية',
        'benefits_en' => 'الفوائد بالإنجيزية',
        'bag_category_id' => 'قسم الحقيبة التعليمية',
        'price' => 'سعر الحقيبة التعليمية',
        'poster' => 'غلاف الفيديو التعريفى بالحقيبة التعليمية',
        'video' => 'الفيديو التعريفى للحقيبة التعليمية',
        'documents' => 'الملفات التعليمية',
        'images' => 'الصور التعليمية',
        'videos' => 'الفيديويهات التعليمية',
        'carts' => 'عربة التسوق',
        'carts.*.id' => 'رقم عربة التسوق',
        'carts.*.bag_id' => 'رقم حقيبة التسوق',
        'carts.*.quantity' => 'الكمية',
        'carts.*.total_price' => 'إجمالى مبلغ عربة التسوق',
        'carts.*.buy_type' => 'نوع الشراء',
        'name' => 'الإسم',
        'email' => 'البريد الإلكترونى',
        'phone_main' => 'الجوال الرئيسى',
        'phone_secondary' => 'الجوال الإضافى',
        'lat' => 'الموقع الجغرافى',
        'long' => 'الموقع الجغرافى',
        'address' => 'الموقع الجغرافى',
        'job_id' => 'الوظيفة المتقدم إاليها',
        'exper_years' => 'عدد سنوات الخبرة',
        'salary' => 'الراتب المتوقع',
        'cv' => 'السيرة الذاتية',
        'work_hours' => 'ساعات العمل',
        'required_number' => 'عدد المتقدمين',
        'free_places' => 'الأماكن الشاغره',
        'required_age' => 'العمر المطلوب',
        'specialization_id' => 'التخصص الوظيفى',
        'other_specialization' => 'التخصص الآخر',
        'address_id' => 'عنوان الشحن',
        'edu_type_id' => 'نوع الدراسة',
        'other_edu_type' => 'نوع دراسة آخر',
        'salary_month' => 'الراتب الشهرى',
        'title_ar' => 'العنوان بالعربية',
        'title_en' => 'العنوان بالإنجليزية',
        'body_ar' => 'النص بالعربية',
        'body_en' => 'النص بالإنجليزية',
        'short_description_ar' => 'الوصف المختصر بالعربية',
        'short_description_en' => 'الوصف المختصر بالإنجليزية',
        'full_description_ar' => 'الوصف الكامل بالعربية',
        'full_description_en' => 'الوصف الكامل بالإنجليزية',
        'vision_title_ar' => 'عنوان الرؤية بالعربية',
        'vision_title_en' => 'عنوان الرؤية بالإنجليزية',
        'vision_text_ar' => 'نص الرؤية بالعربية',
        'vision_text_en' => 'نص الرؤية بالإنجليزية',
        'message_title_ar' => 'عنوان الرسالة بالعربية',
        'message_title_en' => 'عنوان الرسالة بالإنجليزية',
        'message_text_ar' => 'نص الرسالة بالعربية',
        'message_text_ar' => 'نص الرسالة بالإنجليزية',
        'stage_id' => 'المرحلة الدراسية',
        'edu_level_id' => 'المستوى التعليمى',
        'material_ids' => 'المواد التعليمية',
        'nationality_id' => 'الجنسية',
        'teaching_lat' => 'عنوان التدريس',
        'teaching_long' => 'عنوان التدريس',
        'teaching_address' => 'عنوان التدريس',
        'other_stage' => 'مرحلة تعليمية آخرى',
        'other_edu_level' => 'مستوى تعليمى آخر',
        'bio_ar' => 'نبذة مختصرة بالعربية',
        'bio_en' => 'نبذة مختصرة بالإنجليزية',
        'teaching_method' => 'طريقة التعليم',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
    ],
];