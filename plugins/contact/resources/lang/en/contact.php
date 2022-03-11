<?php

return [
    'statuses'              => [
        'read'   => 'Read',
        'unread' => 'Unread',
    ],
    'edit' => 'Edit',
    'name' => 'Name',
    'email' => 'Email',
    'menu_manager' => 'Contact',
    'menu' => 'Contact',
    'new_msg_notice'        => 'You have <span class="bold">:count</span> New Messages',
    'view_all'              => 'View all',
    'settings' => [
        'email' => [
            'title' => 'Contact',
            'description' => 'Contact email configuration',
            'templates' => [
                'notice_title' => 'Send notice to administrator',
                'notice_description' =>'Email template to send notice to administrator when system get new contact'
            ]
        ]
    ]
];