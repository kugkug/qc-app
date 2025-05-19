<?php
return [
    'app_name' => env('APP_NAME', "Quezon City Health Services"),
    'app_title' => env('APP_TITLE', "Q.C. Health Services"),
    'app_favicon' => env('APP_FAVICON', "assets/images/system/qcid_icon.png"),
    
    'payment_signatory' => env('PAYMENT_SIGNATORY', 'RAMONA ASUNCION DG. ABARQUEZ M.D. MPH'),

    'messages' => [
        'default' => 'Cannot continue, please call system administrator!',
    ],

    'application_status' => [
        'application_form' => 1,
        'uploaded_requirements' => 2,
        'validated_requirements' => 3,
        'created_payment' => 4,
        'validated_payment' => 5,
        'seminar' => 6,
        'head_approval' => 7,
        'released' => 8,
        'rejected' => 98,
        'completed' => 99,
    ],

    'requirement_status' => [
        'new' => 1,
        'updated' => 2,
        'rejected' => 3,
        'accepted' => 4,
    ],

    'classification' => [
        'individual' => 1,
        'bulk' => 2,
    ],

    'requirement_status_text' => [
        1 => 'For Review',
        2 => 'Completed',
        3 => 'Requires Update',
    ],

    'requirement_status_class' => [
        'For Review' => '',
        'Completed' => 'text-success',
        'Requires Update' => 'text-danger',
    ],

    'payment_status' => [
        'for-review' => 1,
        'approved' => 2,
        'rejected' => 3,
    ]
];