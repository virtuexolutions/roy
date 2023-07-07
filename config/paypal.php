<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', ''),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', ''),

        'client_id'         => env('AYlp5qIwDbFMgWP1zlYES0h3mvxYkQFKWAht26vkJd6BeK1kiN39HxcYevn03HA5H3dWdQC4ZyYGLk6j', ''),
        'secret'     => env('EJ_hmKgf9UuS38YCEyCN10NF2FLPVz8DIB1sjMBShuMG_cHH4yaZpTvA0LpUFFzBi4-hHzhKUZS7KCQw', ''),
        'app_id'            => 'APP-80W284485P519543T',
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),


    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
