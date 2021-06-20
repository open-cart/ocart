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
];