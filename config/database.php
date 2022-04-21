<?php

return [
    'default' => env('DB_CONNECTION', 'mongodb'),
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', base_path('database/database.sqlite')),
            'prefix' => env('DB_PREFIX', ''),
        ],
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'timezone' => env('DB_TIMEZONE', '+00:00'),
            'strict' => env('DB_STRICT_MODE', false),
        ],
        'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('DB_HOST_NOSQL', '192.168.56.56'),
            'port' => env('DB_PORT_NOSQL', 27017),
            'database' => env('DB_DATABASE_NOSQL', 'homestead'),
            'username' => env('DB_USERNAME_NOSQL', 'homestead'),
            'password' => env('DB_PASSWORD_NOSQL', 'secret'),
            'options' => [
                'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
            ],
        ],
    ]
];
