<?php

return [
    [
        'name' => "Attributes",
        'flag' => "ecommerce.attribute_groups.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.attribute_groups.create",
        'parent_flag' => 'ecommerce.attribute_groups.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.attribute_groups.update",
        'parent_flag' => 'ecommerce.attribute_groups.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.attribute_groups.destroy",
        'parent_flag' => 'ecommerce.attribute_groups.index'
    ],
];
