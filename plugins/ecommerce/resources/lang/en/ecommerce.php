<?php

return [
    'settings'                        => 'Settings',

    'name' => 'Ecommerce',
    'setting' => [
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
        ],

        'separator_comma' => 'Comma (,)',
        'separator_period' => 'Period (.)',
        'separator_space' => 'Space ( )',
        'thousands_separator' => 'Thousands separator',
        'decimal_separator' => 'Decimal separator',

        'other_settings' => 'Other settings',
        'other_setting_descriptions' => 'Other settings description',

        'enable_cart' => 'Enable cart',
        'enable_tax' => 'Enable tax',
        'display_product_price_including_taxes' => 'Display product price including taxes?',
    ],

    'list_order' => 'List orders',
    'statuses'                            => [
        'pending'    => 'Pending',
        'processing' => 'Processing',
        'delivering' => 'Delivering',
        'delivered'  => 'Delivered',
        'completed'  => 'Completed',
        'canceled'   => 'Canceled',
        'default'    => 'Default'
    ],
    'categories' => 'Categories',
    'brand' => 'Brand',

    'store_address'                   => 'Store address',
    'store_phone'                     => 'Store phone',
    'order_id'                        => 'Order code',
    'order_token'                     => 'Order token',
    'customer_name'                   => 'Customer name',
    'customer_email'                  => 'Customer email',
    'customer_phone'                  => 'Customer phone',
    'customer_address'                => 'Customer address',
    'product_list'                    => 'Product list',
    'payment_detail'                  => 'Payment details',
    'shipping_method'                 => 'Shipping method',
    'payment_method'                  => 'Payment method',
    'standard_and_format'             => 'Standard and format',
    'standard_and_format_description' => 'Standards and formats are used to calculate things like product prices, shipping weight, and the time an order is placed.',
    'change_order_format'             => 'Edit order code format (optional)',
    'change_order_format_description' => 'The default order number starts at :number. You can change the start or end string to generate the order number as you like, for example "DH-:number" or ":number-A"',
    'start_with'                      => 'Start with',
    'end_with'                        => 'End with',
    'order_will_be_shown'             => 'Your order number will be displayed in the form',
    'weight_unit'                     => 'Weight unit',
    'height_unit'                     => 'Height unit',
];