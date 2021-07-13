<?php

return [
    'settings_title' => 'Settings',
    'setting' => [
        'separator_comma' => 'Comma (,)',
        'separator_period' => 'Period (.)',
        'separator_space' => 'Space ( )',
        'thousands_separator' => 'Thousands separator',
        'decimal_separator' => 'Decimal separator',

        'other_settings' => 'Other settings',
        'other_setting_descriptions' => 'Other settings description',

        'enable_cart' => 'Enable cart',
        'enable_tax' => 'Enable tax',
        'display_product_price_including_taxes'                                  => 'Display product price including taxes?'
    ],
    'settings' => [
        'email' => [
            'title' => 'Ecommerce',
            'description' => 'Config email templates for Ecommerce',
            'customer_new_order_title' => 'Order confirmation',
            'customer_new_order_description' => 'Send email confirmation to customer when an order placed',

            'customer_cancel_order_title' => 'Order cancellation',
            'customer_cancel_order_description' => 'Send to custom when they cancelled order',

            'delivery_order_title' => 'Delivering confirmation',
            'delivery_order_description' => 'Send to customer when order is delivering',

            'admin_new_order_title' => 'Notice about new order',
            'admin_new_order_description' => 'Send to administrators when an order placed',

            'order_confirm_title' => 'Order confirmation',
            'order_confirm_description' => 'Send to customer when they order was confirmed by admins',

            'order_confirm_payment_title' => 'Payment confirmation',
            'order_confirm_payment_description' => 'Send to customer when their payment was confirmed',

            'order_recover_title' => 'Incomplete order',
            'order_recover_description' => 'Send to custom to remind them about incomplete orders',
        ]
    ]
];