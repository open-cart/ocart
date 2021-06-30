<?php

return [
    'name' => 'plugins/ecommerce::ecommerce.settings.email.title',
    'description' => 'plugins/ecommerce::ecommerce.settings.email.description',
    'templates' => [
        'plugins.ecommerce::emails.customer_new_order' => [
            'title' => 'plugins/ecommerce::ecommerce.settings.email.customer_new_order_title',
            'description' => 'plugins/ecommerce::ecommerce.settings.email.customer_new_order_description',
            'subject' => 'New contact from {{ site_title }}',
        ],
        'plugins.ecommerce::emails.customer_cancel_order' => [
            'title' => 'plugins/ecommerce::ecommerce.settings.email.customer_cancel_order_title',
            'description' => 'plugins/ecommerce::ecommerce.settings.email.customer_cancel_order_description',
            'subject' => 'Order cancelled {{ order_id }}',
        ],
        'plugins.ecommerce::emails.admin_new_order' => [
            'title' => 'plugins/ecommerce::ecommerce.settings.email.admin_new_order_title',
            'description' => 'plugins/ecommerce::ecommerce.settings.email.admin_new_order_description',
            'subject' => 'New order {{ order_id }}',
        ],
        'plugins.ecommerce::emails.delivery_order' => [
            'title' => 'plugins/ecommerce::ecommerce.settings.email.delivery_order_title',
            'description' => 'plugins/ecommerce::ecommerce.settings.email.delivery_order_description',
            'subject' => 'Order delivering {{ order_id }}',
        ],
        'plugins.ecommerce::emails.order_confirm' => [
            'title' => 'plugins/ecommerce::ecommerce.settings.email.order_confirm_title',
            'description' => 'plugins/ecommerce::ecommerce.settings.email.order_confirm_description',
            'subject' => 'Order confirmed {{ order_id }}',
        ],
        'plugins.ecommerce::emails.order_confirm_payment' => [
            'title' => 'plugins/ecommerce::ecommerce.settings.email.order_confirm_payment_title',
            'description' => 'plugins/ecommerce::ecommerce.settings.email.order_confirm_payment_description',
            'subject' => 'Payment for order {{ order_id }} was confirmed',
        ],
        'plugins.ecommerce::emails.order_recover' => [
            'title' => 'plugins/ecommerce::ecommerce.settings.email.order_recover_title',
            'description' => 'plugins/ecommerce::ecommerce.settings.email.order_recover_description',
            'subject' => 'Incomplete order',
        ],
    ],
    'variables' => [
        'store_address'    => 'plugins/ecommerce::ecommerce.store_address',
        'store_phone'      => 'plugins/ecommerce::ecommerce.store_phone',
        'order_id'         => 'plugins/ecommerce::ecommerce.order_id',
        'order_token'      => 'plugins/ecommerce::ecommerce.order_token',
        'customer_name'    => 'plugins/ecommerce::ecommerce.customer_name',
        'customer_email'   => 'plugins/ecommerce::ecommerce.customer_email',
        'customer_phone'   => 'plugins/ecommerce::ecommerce.customer_phone',
        'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
        'product_list'     => 'plugins/ecommerce::ecommerce.product_list',
        'payment_detail'   => 'plugins/ecommerce::ecommerce.payment_detail',
        'shipping_method'  => 'plugins/ecommerce::ecommerce.shipping_method',
        'payment_method'   => 'plugins/ecommerce::ecommerce.payment_method',
    ],
];