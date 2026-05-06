<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dropday API Key
    |--------------------------------------------------------------------------
    |
    | Your Dropday API key, found in your Dropday account settings.
    |
    */
    'api_key' => env('DROPDAY_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Dropday Account ID
    |--------------------------------------------------------------------------
    |
    | Your Dropday account ID, required for every API request.
    |
    */
    'account_id' => env('DROPDAY_ACCOUNT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Dropday Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Dropday API. Override this if you need to point
    | to a staging or local environment.
    |
    */
    'base_url' => env('DROPDAY_BASE_URL', 'https://dropday.io/api/v1'),

];
