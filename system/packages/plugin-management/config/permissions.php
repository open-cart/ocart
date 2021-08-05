<?php

return [
    [
        'name' => "Plugins",
        'flag' => "plugins.index",
        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Active/Deactivate",
        'flag' => "plugins.activate",
        'parent_flag' => 'plugins.index'
    ],
    [
        'name' => "Remove",
        'flag' => "plugins.destroy",
        'parent_flag' => 'plugins.index'
    ],
];
