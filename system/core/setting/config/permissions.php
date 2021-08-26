<?php

return [
    [
        'name' => "Settings",
        'flag' => "settings.options",
        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Email",
        'flag' => "settings.email",
        'parent_flag' => 'settings.options'
    ],
    [
        'name' => "Permalink",
        'flag' => "settings.slug",
        'parent_flag' => 'settings.options'
    ],
];