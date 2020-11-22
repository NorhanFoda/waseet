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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
            'required' => 'Arabic Name is Required',
        ],
        'name_en' => [
            'required' => 'English Name is Required',
        ],
        'image' => [
            'required' => 'The Imagre is required',
            'image' => 'The File must by of Type Image',
            'max' => 'The Image Size Must be Max of ',
            'mimes' => 'The Image Size Must by ',
        ],
        'description_ar' => [
            'required' => 'Arabic Description for Educational Bag is Required',
        ],
        'description_en' => [
            'required' => 'English Description for Educational Bag is Required',
        ],
        'contents_ar' => [
            'required' => 'Arabic Contents for Educational Bag is Required',
        ],
        'contents_en' => [
            'required' => 'English Contents for Educational Bag is Required',
        ],
        'benefits_ar' => [
            'required' => 'Arabic Benefits for Educational Bag is Required',
        ],
        'benefits_en' => [
            'required' => 'English Benefits for Educational Bag is Required',
        ],
        'bag_category_id' => [
            'required' => 'Educational Bag Category is Required',
        ],
        'price' => [
            'required' => 'Education Bag Price is Required',
        ],
        'image' => [
            'image' => 'Educational Bag Image must Be of Type Image',
            'max' => 'Educational Bag Image Must Be of Size ',
            'mimes' => 'Educational Bag Image Must Be of Type ',
        ],
        'poster' => [
            'image' => 'Poster of Educational Bag Video Must Be of Type Image',
            'max' => 'Poster of Educational Bag Video Must Be of Size',
            'mimes' => 'Poster of Educational Bag Video Must Be of Extentions ',
        ],
        'video' => [
            'mimetypes' => 'Educational Bag Video Must Be of Type ',
        ],
        'documents' => [
            'array' => 'You Can Upload One or More Educational Documents',
            'required_without_all' => 'Educational Documents is Required if No Education Images or Videos are Uploaded',
        ],
        'images' => [
            'array' => 'You Can Upload One or More Educational Images',
            'required_without_all' => 'Educational Images is Required if No Education Documents or Videos are Uploaded',
        ],
        'videos' => [
            'array' => 'You Can Upload One or More Educational Vidoes',
            'required_without_all' => 'Educational Videos is Required if No Education Images or Documents are Uploaded',
        ],
        'carts' => [
            'array' => 'You Can Add One or More Item To Shopping Cart',
            'required' => 'Cart is Required',
        ],
        'name' => [
            'required' => 'Name Is Required',
        ],
        'email' => [
            'required' => 'Email Is Required',
            'email' => 'Email Must Be A Valid Email',
            'unique' => 'Email Is Used Before',
        ],
        'phone_main' => [
            'required' => 'Main Phone N umber Is Required',
            'unique' => 'Main Phone Is Used Before',
            'required_if' => 'Main Phone N umber Is Required',
        ],
        'lat' => [
            'required' => 'Location Is Required',
            'required_if' => 'Location Is Required',
        ],
        'long' => [
            'required' => 'Location Is Required',
            'required_if' => 'Location Is Required',
        ],
        'address' => [
            'required' => 'Location Is Required',
            'required_if' => 'Location Is Required',
        ],
        'job_id' => [
            'required' => 'The Job You are Applying to',
        ],
        'exper_years' => [
            'required' => 'Experince Years Count is Required',
            'required_if' => 'Experince Years Count is Required',
        ],
        'salary' => [
            'required' => 'Expected Salary is Required',
            'required_if' => 'Expected Salary is Required',
        ],
        'cv' => [
            'mimetypes' => 'CV File Must Be of Type ',
            'max' => 'CV File Size Must Not Exceed ',
            'required_if' => 'CV is Required',
        ],
        'work_hours' => [
            'required' => 'Works Hours is Required',
        ],
        'required_number' => [
            'required' => 'Required Number of Applicants is Required',
        ],
        'free_places' => [
            'required' => 'Free Places is Required',
        ],
        'required_age' => [
            'required' => 'Required Age for The Job is Required',
        ],
        'specialization_id' => [
            'required' => 'job Specializarion is Required',
        ],
        'other_specialization' => [
            'required_if' => 'Write Other Specialization',
        ],
        'address_id' => [
            'required' => 'Sgipping Address is Required',
        ],
        'edu_type_id' => 
        [
            'required' => 'Educatinal Type is Required',
            'required_if' => 'Educatinal Type is Required',
        ],
        'other_edu_type' => 
        [
            'required_if' => 'Other Educational Type is required',
        ],
        'salary_month' => [
            'required' => 'Monthly Salary is Required',
        ],
        'title_ar' => [
            'required' => 'Arabic Title is Required',
        ],
        'title_en' => [
            'required' => 'Englidh Title is Required',
        ],
        'body_ar' => [
            'required' => 'Arabic Content is Required',
        ],
        'body_en' => [
            'required' => 'English Content is Required',
        ],
        'short_description_ar' => [
            'required' => 'Arabic Short Description is Required',
            'max' => 'Arabic Short Description Must Not Exceed 190 Characters',
        ],
        'short_description_en' => [
            'required' => 'English Short Description is Required',
            'max' => 'English Short Description Must Not Exceed 190 Characters',
        ],
        'full_description_ar' => [
            'required' => 'Arabic Full Description is Required',
        ],
        'full_description_en' => [
            'required' => 'English Full Description is Required',
        ],
        'vision_title_ar' => [
            'required_if' => 'Arabic Vision Title is Required',
        ],
        'vision_title_en' => [
            'required_if' => 'English Vision Title is Required',
        ],
        'vision_text_ar' => [
            'required_if' => 'Arabic Vision Text is Required',
        ],
        'vision_text_en' => [
            'required_if' => 'English Vision Text is Required',
        ],
        'message_title_ar' => [
            'required_if' => 'Arabic Message Title is Required',
        ],
        'message_title_en' => [
            'required_if' => 'English Message Title is Required',
        ],
        'message_text_ar' => [
            'required_if' => 'Arabic Message Text is Required',
        ],
        'message_text_ar' => [
            'required_if' => 'English Message Text is Required',
        ],
        'stage_id' => [
            'required' => 'Stage is Required',
            'required_if' => 'Stage is Required',
        ],
        'edu_level_id' => [
            'required' => 'Educatinal Level is Required',
            'required_if' => 'Educatinal Level is Required',
        ],
        'material_ids' => [
            'required' => 'Educatinal Materials are Required',
        ],
        'nationality_id' => [
            'required' => 'Natinality is Required',
        ],
        'teaching_lat' => [
            'required' => 'Teaching Address is Required',
            'required_if' => 'Teaching Address is Required',
        ],
        'teaching_long' => [
            'required' => 'Teaching Address is Required',
            'required_if' => 'Teaching Address is Required',
        ],
        'teaching_address' => [
            'required' => 'Teaching Address is Required',
            'required_if' => 'Teaching Address is Required',
        ],
        'other_stage' => [
            'required_if' => 'Other Stage is Required',
        ],
        'other_edu_level' => [
            'required_if' => 'Other Educational Level is Required',
        ],
        'bio_ar' => [
            'required_if' => 'Arabic Bio is Required',
        ],
        'bio_en' => [
            'required_if' => 'English Bio is Required',
        ],
        'teaching_method' => [
            'required_if' => 'Teaching Method is Required',
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
        'name_ar' => 'Arabic Name',
        'name_en' => 'English Name',
        'image' => 'Image',
        'description_ar' => 'Arabic Description for Educational Bag',
        'description_en' => 'English Description for Educational Bag',
        'contents_ar' => 'Arabic Contents for Educational Bag',
        'contents_en' => 'English Contents for Educational Bag',
        'benefits_ar' => 'Arabic Benefits for Educational Bag',
        'benefits_en' => 'English Benefits for Educational Bag',
        'bag_category_id' => 'Educational Bag Category',
        'price' => 'Educational Bag price',
        'poster' => 'Educational Bag Poster',
        'video' => 'Educational Bag Video',
        'documents' => 'Educational Documents',
        'images' => 'Educational Images',
        'videos' => 'Educational Videos',
        'carts' => 'Carts',
        'carts.*.id' => 'Cart\'s ID',
        'carts.*.bag_id' => 'Bag\'s ID',
        'carts.*.quantity' => 'Quantity',
        'carts.*.total_price' => 'Cart\'s Total Price',
        'carts.*.buy_type' => 'Buy Type',
        'name' => 'Name',
        'email' => 'Email',
        'phone_main' => 'Main Phone',
        'phone_secondary' => 'Secondary Phone',
        'lat' => 'Location',
        'long' => 'Location',
        'address' => 'Location',
        'job_id' => 'The job you are applying to',
        'exper_years' => 'Experience Years',
        'salary' => 'Expected Salary',
        'cv' => 'C.V.',
        'work_hours' => 'Work Hours',
        'exper_years' => 'Experience Years',
        'required_number' => 'Required Number of Applicants',
        'free_places' => 'Free Places for Jobs',
        'required_age' => 'Required Age for Job',
        'specialization_id' => 'Job Specialization',
        'other_specialization' => 'Other Job Specialization',
        'address_id' => 'Shipping Address',
        'edu_type_id' => 'Educatinal Type',
        'other_edu_type' => 'Other Educational Type',
        'Monthly Salary' => 'Monthly Salary',
        'title_ar' => 'Arabic Title',
        'title_en' => 'English Title',
        'body_ar' => 'Arabic Content',
        'body_en' => 'English Content',
        'short_description_ar' => 'Arabic Short Description',
        'short_description_en' => 'English Short Description',
        'full_description_ar' => 'Arabic Full Description',
        'full_description_en' => 'English Full Description',
        'vision_title_ar' => 'Arabic Vision Title',
        'vision_title_en' => 'English Vision Title',
        'vision_text_ar' => 'Arabic Vision Text',
        'vision_text_en' => 'English Vision Text',
        'message_title_ar' => 'Arabic Message Title',
        'message_title_en' => 'English Message Title',
        'message_text_ar' => 'Arabic Message Text',
        'message_text_ar' => 'English Message Text',
        'stage_id' => 'Stage',
        'edu_level_id' => 'Educational Level',
        'material_ids' => 'Educational Materials',
        'nationality_id' => 'Nationality',
        'teaching_lat' => 'Teaching Address',
        'teaching_long' => 'Teaching Address',
        'teaching_address' => 'Teaching Address',
        'other_stage' => 'Other Stage',
        'other_edu_level' => 'Other Educational Level',
        'bio_ar' => 'Arabic Bio',
        'bio_en' => 'English Bio',
        'teaching_method' => 'Teaching Method',
    ],

];
