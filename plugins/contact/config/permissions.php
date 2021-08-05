<?php

return [
    [
        'name' => "Contacts",
        'flag' => "contacts.index",
//        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Create",
        'flag' => "contacts.create",
        'parent_flag' => 'contacts.index'
    ],
    [
        'name' => "Edit",
        'flag' => "contacts.update",
        'parent_flag' => 'contacts.index'
    ],
    [
        'name' => "Delete",
        'flag' => "contacts.destroy",
        'parent_flag' => 'contacts.index'
    ]
];
