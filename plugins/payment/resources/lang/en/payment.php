<?php

return [
    'statuses'                              => [
        'pending'   => 'Pending',
        'completed' => 'Completed',
        'refunding' => 'Partially refunded',
        'refunded'  => 'Refunded',
        'fraud'     => 'Fraud',
        'failed'    => 'Failed',
    ],
    'methods'                               => [
        'paypal'        => 'PayPal',
        'stripe'        => 'Stripe',
        'cod'           => 'Cash on delivery (COD)',
        'bank_transfer' => 'Bank transfer',
    ],
    'menu' => [
        'payments'          => 'Payments',
        'payment_method'    => 'Payment Method',
        'transaction'       => 'Transaction',
    ],
    'amount'                               => 'Amount',
    'charge_id'           => 'Charge id',
    'payment_method' => 'Payment method',
    'payment_methods' => 'Payment methods',
    'payment_channel' => 'Payment channel',
    'edit_transaction'                                  => 'Update transaction',

    'created_at' => 'Created at',
    'total' => 'Total',
    'status' => 'Status',
    'information' => 'Information',
    'search' => [
        'label' => 'Search',
        'placeholder' => 'Search...',
    ],
    'select_method' => '--Select method--',
    'select_status' => '--Select status--',
    'default_payment_method' => 'Default payment method',
    'setup_payment_method_for_website' => 'Setup payment methods for website',
    'guide_customers_to_pay_direct_you_can_choose_to_pay_by_delivery_or_bank_transfer' => 'Guide customers to pay directly. You can choose to pay by delivery or bank transfer',
    'use' => 'Use',
    'method_name' => 'Method name',
    'payment_guide' => 'Payment guide - (Displayed on the notice of successful purchase and payment page)',
];