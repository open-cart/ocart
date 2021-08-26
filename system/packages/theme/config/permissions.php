<?php

return [
    [
        'name' => "Theme",
        'flag' => "themes.index",
//        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Activate",
        'flag' => "themes.activate",
        'parent_flag' => 'themes.index'
    ],
    [
        'name' => "Remove",
        'flag' => "themes.destroy",
        'parent_flag' => 'themes.index'
    ],
    [
        'name' => "Theme Options",
        'flag' => "themes.options",
        'parent_flag' => 'themes.index'
    ],
];
