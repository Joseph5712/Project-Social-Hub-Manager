<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
        
    ],
    'linkedin' => [
    'client_id' => "782jqozziylt5p",
    'client_secret' => "WPL_AP1.zAdhTI5CBVFqsGZv.2VmpsA==",
    'access_token' => "AQXMPJjchSqnJZv5pgi8hcRCfHcPkZ2ixXfdcR670MQP8OLRZt8hnjsdr4rUVrQkJh4f_0L71c6Kwz5WLCJavshK4k_Uq9ZvI1iWfs3monylxFcjCfLyPQigmlWIqnwdDjFasxwb7UhkivfXs6qyCUHyOXi5EGMnP0_DCankaFWSkoSae72wPAkeXmIQXGhqqSowUa6fS7LCwrZfdgkYdrB11qYYVsPJkRzZERuLO-j6Q2tMxqwaQSYfC_EDMkfLu_2dyeBjXp5Q3-9FBiYtLY4FHsxffTm2kpVUbr2a5uhRAjIy7w2eGMO67cTRKVxwWtvqv-IqXffHO67ftM08Qq1-rIcHvQ",
    'redirect' => "http://project.mysocialhub.xyz/auth/linkedin/callback",
    ],

    'twitter' => [
    'client_id' => env('TWITTER_API_KEY'), // API Key
    'client_secret' => env('TWITTER_API_SECRET'), // API Secret Key
    'redirect' => env('TWITTER_REDIRECT_URI'), // URL de redirección
    ],
];
