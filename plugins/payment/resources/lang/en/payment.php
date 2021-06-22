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
    'select_status' => '--Select status--'
];