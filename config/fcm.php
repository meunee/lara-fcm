<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => true,
    'timeout' => 30,

    'firebase_config' => [
        'apiKey' => env('FCM_API_KEY'),
        'authDomain' => env('FCM_AUTH_DOMAIN'),
        'projectId' => env('FCM_PROJECT_ID'),
        'storageBucket' => env('FCM_STORAGE_BUCKET'),
        'messagingSenderId' => env('FCM_MESSAGIN_SENDER_ID'),
        'appId' => env('FCM_APP_ID')
    ],

    'fcm_api_send_url' => "https://fcm.googleapis.com/v1/projects/". env('FCM_PROJECT_ID') . "/messages:send",
    'fcm_api_group_url' => "https://fcm.googleapis.com/v1/projects/". env('FCM_PROJECT_ID') . "/messages:send", // deprecated
    'fcm_api_server_key' => env('FCM_API_SERVER_KEY'),
    'fcm_json_path' => base_path() . '/' . env('FCM_JSON'),
];
