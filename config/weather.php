<?php

return [
    'app_id' => env('WEATHER_APP_ID', "NOAPPID"),
    'app_code' => env('WEATHER_APP_CODE', "NOAPPCODE"),
    'lat_default' => env('WEATHER_LAT_DEFAULT', 0),
    'lng_default' => env('WEATHER_LNG_DEFAULT', 0),
    'locations' => [
        'new_york' => ['lat' => '40.730610', 'long' => '-73.935242'],
        'tokio' => ['lat' => '35.652832', 'long' => '139.839478'],
        'berlin' => ['lat' => '52.520008', 'long' => '13.404954'],
        'london' => ['lat' => '51.509865', 'long' => '-0.118092'],
        'paris' => ['lat' => '48.864716', 'long' => '2.349014'],
    ]
];

