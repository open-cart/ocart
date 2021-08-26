<?php

return [
    [
        'name' => "Menus",
        'flag' => "menus.index",
//        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Create",
        'flag' => "menus.create",
        'parent_flag' => 'menus.index'
    ],
    [
        'name' => "Edit",
        'flag' => "menus.update",
        'parent_flag' => 'menus.index'
    ],
    [
        'name' => "Delete",
        'flag' => "menus.destroy",
        'parent_flag' => 'menus.index'
    ]
];
