<?php

return [
    'name' => 'plugins/ecommerce::ecommerce.setting.email.title',
    'description' => 'plugins/ecommerce::ecommerce.setting.email.description',
    'templates' => [
        'plugins.ecommerce::emails.customer_new_order' => [
            'title' => 'plugins/ecommerce::ecommerce.setting.email.customer_new_order_title',
            'description' => 'plugins/ecommerce::ecommerce.setting.email.customer_new_order_description',
            'subject' => 'New contact from {{ site_title }}',
            'can_off' => true,
            'enabled'     => false,
        ],
        'plugins.ecommerce::emails.customer_cancel_order' => [
            'title' => 'plugins/ecommerce::ecommerce.setting.email.customer_cancel_order_title',
            'description' => 'plugins/ecommerce::ecommerce.setting.email.customer_cancel_order_description',
            'subject' => 'Order cancelled {{ order_id }}',
            'can_off' => true
        ],
        'plugins.ecommerce::emails.admin_new_order' => [
            'title' => 'plugins/ecommerce::ecommerce.setting.email.admin_new_order_title',
            'description' => 'plugins/ecommerce::ecommerce.setting.email.admin_new_order_description',
            'subject' => 'New order {{ order_id }}',
            'can_off' => true,
            'enabled'     => false,
        ],
        'plugins.ecommerce::emails.delivery_order' => [
            'title' => 'plugins/ecommerce::ecommerce.setting.email.delivery_order_title',
            'description' => 'plugins/ecommerce::ecommerce.setting.email.delivery_order_description',
            'subject' => 'Order delivering {{ order_id }}',
            'can_off' => true
        ],
        'plugins.ecommerce::emails.order_confirm' => [
            'title' => 'plugins/ecommerce::ecommerce.setting.email.order_confirm_title',
            'description' => 'plugins/ecommerce::ecommerce.setting.email.order_confirm_description',
            'subject' => 'Order confirmed {{ order_id }}',
            'can_off' => true
        ],
        'plugins.ecommerce::emails.order_confirm_payment' => [
            'title' => 'plugins/ecommerce::ecommerce.setting.email.order_confirm_payment_title',
            'description' => 'plugins/ecommerce::ecommerce.setting.email.order_confirm_payment_description',
            'subject' => 'Payment for order {{ order_id }} was confirmed',
            'can_off' => true
        ],
//        'plugins.ecommerce::emails.order_recover' => [
//            'title' => 'plugins/ecommerce::ecommerce.setting.email.order_recover_title',
//            'description' => 'plugins/ecommerce::ecommerce.setting.email.order_recover_description',
//            'subject' => 'Incomplete order',
//            'can_off' => true
//        ],
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