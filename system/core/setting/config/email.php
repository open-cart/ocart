<?php

return [
    'name'        => 'core/setting::setting.email_templates',
    'description' => 'core/setting::setting.base_template_for_all_emails',
    'templates'   => [
        'core::emails.header'  => [
            'title'       => 'core/setting::setting.email_template_header',
            'description' => 'core/setting::setting.template_for_header_of_emails',
        ],
        'core::emails.footer'  => [
            'title'       => 'core/setting::setting.email_template_footer',
            'description' => 'core/setting::setting.template_for_footer_of_emails',
        ],
    ],
];
