

<?php
return [
    'client_id' => env('PAYPAL_CLIENT_ID', 'ARS5OyCf7EwZ46P5YjPQ20XPaoeTXjoIn5XaiAhYqrSvAKsDk7Qbt40yDWxnW_U6rI-BXH3GvUcWcldT'),
    'secret' => env('PAYPAL_SECRET', 'EFFwCmpUygreCAnSxYeVYZ2pvm1WE6kRExRz6hpUnVK7JAcrlrNk8hWaZWdSt_TrLvQagol0Vo--mhHC'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 300,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];
