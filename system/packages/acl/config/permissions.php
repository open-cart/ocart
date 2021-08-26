<?php

return [
    [
        'name' => 'System',
        'flag' => 'core.system',
    ],

    [
        'name' => "Users",
        'flag' => "system.users.index",
        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Create",
        'flag' => "system.users.create",
        'parent_flag' => 'system.users.index'
    ],
    [
        'name' => "Edit",
        'flag' => "system.users.update",
        'parent_flag' => 'system.users.index'
    ],
    [
        'name' => "Delete",
        'flag' => "system.users.destroy",
        'parent_flag' => 'system.users.index'
    ],

    [

        'name' => 'Roles',
        'flag' => 'system.roles.index',
        'parent_flag' => 'core.system'
    ],
    [
        'name' => 'Create',
        'flag' => 'system.roles.create',
        'parent_flag' => 'system.roles.index'
    ],
    [
        'name' => 'Edit',
        'flag' => 'system.roles.update',
        'parent_flag' => 'system.roles.index'
    ],
    [
        'name' => 'Delete',
        'flag' => 'system.roles.destroy',
        'parent_flag' => 'system.roles.index'
    ],
];
