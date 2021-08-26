<?php

return [
    [
        'name' => "Reviews",
        'flag' => "ec_review.reviews.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ec_review.reviews.create",
        'parent_flag' => 'ec_review.reviews.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ec_review.reviews.update",
        'parent_flag' => 'ec_review.reviews.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ec_review.reviews.destroy",
        'parent_flag' => 'ec_review.reviews.index'
    ],
];
