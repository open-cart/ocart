<?php

return [
    'DB_PREFIX' => env('DB_PREFIX', ''),
    'ADMIN_PREFIX' => env('ADMIN_PREFIX', 'admin'),
    'LOG_SLACK_WEBHOOK_URL' => env('LOG_SLACK_WEBHOOK_URL',''),
    'MAIL_HOST' => env('MAIL_HOST',''),
    'MAIL_PORT' => env('MAIL_PORT',''),
    'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION',''),
    'MAIL_USERNAME' => env('MAIL_USERNAME',''),
    'MAIL_PASSWORD' => env('MAIL_PASSWORD',''),
];
