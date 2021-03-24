<?php

return [
    'offline'        => env('ASSETS_OFFLINE', true),
    'enable_version' => env('ASSETS_ENABLE_VERSION', false),
    'version'        => env('ASSETS_VERSION', time()),
    'scripts'        => [
        'jquery',
        'app',
        'pjax',
        'tnmedia',
    ],
    'styles'         => [
        'app',
        'swal',
        'tnmedia',
    ],
    'resources'      => [
        'scripts' => [
            'app'       => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => '/js/app.js',
                ],
                'attributes' => [
                    'defer' => true
                ]
            ],
            'modernizr' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => '/vendor/core/packages/modernizr/modernizr.min.js',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js',
                ],
            ],
            'jquery' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/jquery/jquery.min.js',
                ],
            ],
            'pjax' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/jquery.pjax.js',
                ],
            ],
            'tnmedia' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => 'tnmedia/bundle.js',
                ],
            ],
        ],
        'styles'  => [
            'app' => [
                'use_cdn'    => false,
                'location'   => 'header',
                'src'        => [
                    'local' => 'css/app.css',
                ],
            ],
            'swal' => [
                'use_cdn'    => false,
                'location'   => 'header',
                'src'        => [
                    'local' => 'css/swal.css',
                ],
            ],
            'tnmedia' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => 'tnmedia/app.css',
                ],
            ],
        ],
    ],
];
