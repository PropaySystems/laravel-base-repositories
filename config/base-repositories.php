<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base Service class folder
    |--------------------------------------------------------------------------
    | This is the base service class folders usually located in the app folder.
    */
    'base_service_path' => env('BASE_SERVICE_PATH', 'app'.DIRECTORY_SEPARATOR.'Services'.DIRECTORY_SEPARATOR),

    /*
    |--------------------------------------------------------------------------
    | Base Repository class folder
    |--------------------------------------------------------------------------
    | This is the base repository class folders usually located in the app folder.
    */
    'base_repository_path' => env('BASE_REPOSITORY_PATH', 'app'.DIRECTORY_SEPARATOR.'Repositories'.DIRECTORY_SEPARATOR),

];
