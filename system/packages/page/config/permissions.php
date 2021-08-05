<?php

return [
    [
        'name' => "Page",
        'flag' => "pages.index",
//        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Create",
        'flag' => "pages.create",
        'parent_flag' => 'pages.index'
    ],
    [
        'name' => "Edit",
        'flag' => "pages.update",
        'parent_flag' => 'pages.index'
    ],
    [
        'name' => "Delete",
        'flag' => "pages.destroy",
        'parent_flag' => 'pages.index'
    ]
];
