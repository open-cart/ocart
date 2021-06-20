<?php

return [
    'statuses'                              => [
        'pending'   => 'Chưa hoàn tất',
        'completed' => 'Đã hoàn thành',
        'refunding' => 'Đã hoàn một phần',
        'refunded'  => 'Đã hoàn tiền',
        'fraud'     => 'Gian lận',
        'failed'    => 'Thất bại',
    ],
    'methods'                               => [
        'paypal'        => 'PayPal',
        'stripe'        => 'Stripe',
        'cod'           => 'Cash on delivery (COD)',
        'bank_transfer' => 'Bank transfer',
    ],
];