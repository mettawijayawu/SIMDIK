<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        // KOREKSI UTAMA DI SINI
        'gcs' => [
            'driver' => 's3', 
        'key' => env('GCS_ACCESS_KEY_ID'), // Kunci Akses (dari Akun Layanan)
        'secret' => env('GCS_SECRET_ACCESS_KEY'), // Kunci Rahasia
        'region' => 'auto', // GCS tidak menggunakan region, tapi ini wajib
        'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET'),
        'pathPrefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', null), // Opsional
        'url' => env('AWS_URL'),
        // Endpoint GCS yang kompatibel dengan S3
        'endpoint' => 'https://storage.googleapis.com', 
        'use_path_style_endpoint' => true, 
        'throw' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
