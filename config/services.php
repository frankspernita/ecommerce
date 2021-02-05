<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],	
		
	'facebook' => [
		'client_id' => '2864520957007644',
		'client_secret' => '631186aa95ef23419f2b3f567ea31003',
		'redirect' => 'https://ecommercev2.sppflash.com.ar/login/facebook/callback',
	],
	
	
	'google' => [
		'client_id' => '513522338109-ojcq3cue9r44i9321e9kdng6v2efh1qi.apps.googleusercontent.com',
		'client_secret' => 'QL0lpaAE3DTGTwMRvpBTUVhI',
		'redirect' => 'https://ecommercev2.sppflash.com.ar/login/google/callback',
	],

];
