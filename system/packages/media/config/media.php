<?php

return [
    'max_quota'               => env('TN_MEDIA_MAX_QUOTA', 1024 * 1024 * 1024),
    'sizes'                   => [
        'thumb' => '150x150',
    ],
    'route'                   => [
//        'prefix'     => ADMIN_PREFIX . '/media',
        'prefix'     => 'api/media',
        'middleware' => ['web', 'auth'],
        'options'    => [
            'permission' => 'media.index',
        ],
    ],
    'allowed_mime_types'      => env('RV_MEDIA_ALLOWED_MIME_TYPES',
        'jpg,jpeg,png,gif,txt,docx,zip,mp3,bmp,csv,xls,xlsx,ppt,pptx,pdf,mp4,doc,mpga,wav'),
    'views'                   => [
        'index' => 'core/media::index',
    ],
    'max_file_size_upload'    => env('RV_MEDIA_MAX_FILE_SIZE_UPLOAD', 4 * 1024 * 1024), // Maximum size to upload
    'default-img'             => env('RV_MEDIA_DEFAULT_IMAGE', '/vendor/core/images/placeholder.png'), // Default image
    'sidebar_display'         => env('RV_MEDIA_SIDEBAR_DISPLAY', 'horizontal'), // Use "vertical" or "horizontal"
    'watermark'               => [
        'source'   => env('RV_MEDIA_WATERMARK_SOURCE'),
        'position' => env('RV_MEDIA_WATERMARK_POSITION', 'bottom-right'),
        'x'        => env('RV_MEDIA_WATERMARK_X', 10),
        'y'        => env('RV_MEDIA_WATERMARK_Y', 10),
    ],
    'mime_types'              => [
        'image'    => [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/bmp',
        ],
        'video'    => [
            'video/mp4',
        ],
        'document' => [
            'application/pdf',
            'application/vnd.ms-excel',
            'application/excel',
            'application/x-excel',
            'application/x-msexcel',
            'text/plain',
            'application/msword',
            'text/csv',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ],
        'youtube'  => [
            'youtube',
        ],
    ],
];