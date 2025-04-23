<?php

return [
    'base_url' => 'https://openexchangerates.org/api',
    'app_id' => env('OPEN_EXCHANGE_APP_ID'),
    'endpoints' => ['latest' => '/latest.json']
];
