<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [

        'guard' => 'web',

        'passwords' => 'users',

    ],



    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [

        /*
        | Default guard
        */
        'web' => [

            'driver' => 'session',

            'provider' => 'users',

        ],



        /*
        | Guard Admin
        */
        'admin' => [

            'driver' => 'session',

            'provider' => 'admins',

        ],



        /*
        | Guard Siswa
        */
        'siswa' => [

            'driver' => 'session',

            'provider' => 'siswas',

        ],

    ],



    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        /*
        | Default users
        */
        'users' => [

            'driver' => 'eloquent',

            'model' => App\Models\User::class,

        ],



        /*
        | Provider Admin
        */
        'admins' => [

            'driver' => 'eloquent',

            'model' => App\Models\Admin::class,

        ],



        /*
        | Provider Siswa
        */
        'siswas' => [

            'driver' => 'eloquent',

            'model' => App\Models\Siswa::class,

        ],

    ],



    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [

        'users' => [

            'provider' => 'users',

            'table' => 'password_reset_tokens',

            'expire' => 60,

            'throttle' => 60,

        ],

    ],



    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];
