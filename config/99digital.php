<?php

return [

    /*
    |--------------------------------------------------------------------------
    | WhatsApp "From" Number
    |--------------------------------------------------------------------------
    |
    | This configuration option defines the phone number that will be used as
    | the "from" number for all outgoing whatsapp messages. You should provide
    | the number you have already reserved within your 99digital account.
    |
    */

    'from' => env('99DIGITAL_FROM'),

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    |
    | The following configuration options contain your API credentials, which
    | may be accessed from your 99digital account. These credentials may be
    | used toauthenticate with the 99digital API so you may send messages.
    |
    */

    'api_key' => env('99DIGITAL_KEY'),

    'api_url' => env('99DIGITAL_URL', 'https://api.99digital.co.il/whatsapp/v2/sendTemplate'),

];
