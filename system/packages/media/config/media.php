<?php

return [
    'max_quota'               => env('TN_MEDIA_MAX_QUOTA', 1024 * 1024 * 1024),
    'sizes'                   => [
        'thumb' => '150x150',
    ],
    'route'                   => [
        'prefix'     => ADMIN_PREFIX . '/media',
        'middleware' => ['web', 'auth'],
        'options'    => [
            'permission' => 'media.index',
        ],
    ],
    'views'                   => [
        'index' => 'core/media::index',
    ],
    'max_file_size_upload'    => env('RV_MEDIA_MAX_FILE_SIZE_UPLOAD', 4 * 1024 * 1024), // Maximum size to upload
    'default-img'             => env('RV_MEDIA_DEFAULT_IMAGE', '/vendor/core/images/placeholder.png'), // Default image
    'sidebar_display'         => env('RV_MEDIA_SIDEBAR_DISPLAY', 'horizontal'), // Use "vertical" or "horizontal"
];