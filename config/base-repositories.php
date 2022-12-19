<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base Service class folder
    |--------------------------------------------------------------------------
    | This is the base service class folders usually located in the app folder.
    */
    'base_service_path' => env('BASE_SERVICE_PATH', 'app' . DIRECTORY_SEPARATOR . 'Services' . DIRECTORY_SEPARATOR),

    /*
    |--------------------------------------------------------------------------
    | Append Service class
    |--------------------------------------------------------------------------
    | This is will append to the file that gets created.
    */
    'append_service_name' => env('APPEND_SERVICE_NAME', 'Service'),

    /*
    |--------------------------------------------------------------------------
    | Base Repository class folder
    |--------------------------------------------------------------------------
    | This is the base repository class folders usually located in the app folder.
    */
    'base_repository_path' => env('BASE_REPOSITORY_PATH', 'app' . DIRECTORY_SEPARATOR . 'Repositories' . DIRECTORY_SEPARATOR),

    /*
    |--------------------------------------------------------------------------
    | Append Repository class
    |--------------------------------------------------------------------------
    | This is will append to the file that gets created.
    */
    'append_repository_name' => env('APPEND_REPOSITORY_NAME', 'Repository'),

    /*
    |--------------------------------------------------------------------------
    | Base Interface class folder
    |--------------------------------------------------------------------------
    | This is the base interface class folders usually located in the app folder.
    */
    'base_interface_path' => env('BASE_INTERFACE_PATH', 'Interfaces'),

];
