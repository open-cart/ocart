<?php

return [
    [
        'name' => "Payments",
        'flag' => "payments.transactions.index",
//        'parent_flag' => 'core.system'
    ],
    [
        'name' => "Settings",
        'flag' => "payments.settings",
        'parent_flag' => 'payments.transactions.index'
    ],

//    [
//        'name' => "Create",
//        'flag' => "payments.transactions.create",
//        'parent_flag' => 'payments.transactions.index'
//    ],
    [
        'name' => "Edit",
        'flag' => "payments.transactions.update",
        'parent_flag' => 'payments.transactions.index'
    ],
    [
        'name' => "Delete",
        'flag' => "payments.transactions.destroy",
        'parent_flag' => 'payments.transactions.index'
    ]
];
