<?php
return [
    'app_name' => env('APP_NAME', "Quezon City Health Services"),
    'app_title' => env('APP_TITLE', "Q.C. Health Services"),
    'app_favicon' => env('APP_FAVICON', "assets/images/system/qcid_icon.png"),

    'messages' => [
        'default' => 'Cannot continue, please call system administrator!',
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
];