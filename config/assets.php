<?php

return [
    'offline'        => env('ASSETS_OFFLINE', true),
    'enable_version' => env('ASSETS_ENABLE_VERSION', false),
    'version'        => env('ASSETS_VERSION', time()),
    'scripts'        => [
        'spruce',
        'jquery',
        'jquery-ui',
        'app',
        'pjax',
        'tnmedia',
        'tinymce',
    ],
    'styles'         => [
        'app',
        'jquery-ui',
        'swal',
        'tnmedia',
        'font',
    ],
    'resources'      => [
        'scripts' => [
            'spruce' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src' => [
                    'local' => 'https://cdn.jsdelivr.net/npm/@ryangjchandler/spruce@2.6.3/dist/spruce.umd.js',
                ]
            ],
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
            'jquery-ui' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/jquery-ui/jquery-ui.js',
                    'cdn' => 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
                ],
            ],
            'tinymce' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/tinymce/tinymce.min.js',
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
            'simplemde' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/simplemde/simplemde.min.js',
                ],
            ],
            'prismjs' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/prismjs/prism.js',
                ],
            ],
        ],
        'styles'  => [
            'jquery-ui' => [
                'use_cdn'    => false,
                'location'   => 'header',
                'src'        => [
                    'local' => 'access/jquery-ui/jquery-ui.css',
                ],
            ],'app' => [
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
            'font' => [
                'use_cdn'  => false,
                'location' => 'header',
                'src'      => [
                    'local' => 'css/fontawesome/css/all.min.css',
                ],
            ],
            'simplemde' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/simplemde/simplemde.min.css',
                ],
            ],
            'prismjs' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => 'access/prismjs/prism.css',
                ],
            ],


//            'tinymce' => [
//                'use_cdn'  => false,
//                'location' => 'header',
//                'src'      => [
//                    'local' => 'access/tinymce/tinymce.min.js',
//                ],
//            ],
        ],
    ],
];
