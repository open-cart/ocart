<?php

return [
    [
        'name' => "Media",
        'flag' => "media.index",
    ],
    [
        'name' => "Create",
        'flag' => "media.create",
        'parent_flag' => 'media.index'
    ],
    [
        'name' => "Edit",
        'flag' => "media.update",
        'parent_flag' => 'media.index'
    ],
    [
        'name' => "Delete",
        'flag' => "media.destroy",
        'parent_flag' => 'media.index'
    ],
];