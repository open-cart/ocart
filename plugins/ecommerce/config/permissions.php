<?php

return [
    [
        'name' => "E-commerce",
        'flag' => "ecommerce",
//        'parent_flag' => 'core.system'
    ],

    [
        'name' => "Products",
        'flag' => "ecommerce.products.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.products.create",
        'parent_flag' => 'ecommerce.products.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.products.update",
        'parent_flag' => 'ecommerce.products.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.products.destroy",
        'parent_flag' => 'ecommerce.products.index'
    ],

    [
        'name' => "Customers",
        'flag' => "ecommerce.customers.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.customers.create",
        'parent_flag' => 'ecommerce.customers.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.customers.update",
        'parent_flag' => 'ecommerce.customers.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.customers.destroy",
        'parent_flag' => 'ecommerce.customers.index'
    ],

    [
        'name' => "Brands",
        'flag' => "ecommerce.brands.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.brands.create",
        'parent_flag' => 'ecommerce.brands.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.brands.update",
        'parent_flag' => 'ecommerce.brands.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.brands.destroy",
        'parent_flag' => 'ecommerce.brands.index'
    ],

    [
        'name' => "Categories",
        'flag' => "ecommerce.categories.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.categories.create",
        'parent_flag' => 'ecommerce.categories.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.categories.update",
        'parent_flag' => 'ecommerce.categories.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.categories.destroy",
        'parent_flag' => 'ecommerce.categories.index'
    ],

    [
        'name' => "Currencies",
        'flag' => "ecommerce.currencies.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.currencies.create",
        'parent_flag' => 'ecommerce.currencies.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.currencies.update",
        'parent_flag' => 'ecommerce.currencies.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.currencies.destroy",
        'parent_flag' => 'ecommerce.currencies.index'
    ],

    [
        'name' => "Orders",
        'flag' => "ecommerce.orders.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.orders.create",
        'parent_flag' => 'ecommerce.orders.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.orders.update",
        'parent_flag' => 'ecommerce.orders.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.orders.destroy",
        'parent_flag' => 'ecommerce.orders.index'
    ],

    [
        'name' => "Tags",
        'flag' => "ecommerce.tags.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.tags.create",
        'parent_flag' => 'ecommerce.tags.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.tags.update",
        'parent_flag' => 'ecommerce.tags.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.tags.destroy",
        'parent_flag' => 'ecommerce.tags.index'
    ],

    [
        'name' => "Taxes",
        'flag' => "ecommerce.taxes.index",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Create",
        'flag' => "ecommerce.taxes.create",
        'parent_flag' => 'ecommerce.taxes.index'
    ],
    [
        'name' => "Edit",
        'flag' => "ecommerce.taxes.update",
        'parent_flag' => 'ecommerce.taxes.index'
    ],
    [
        'name' => "Delete",
        'flag' => "ecommerce.taxes.destroy",
        'parent_flag' => 'ecommerce.taxes.index'
    ],

    [
        'name' => "Shipping",
        'flag' => "ecommerce.shipping",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Settings",
        'flag' => "ecommerce.settings",
        'parent_flag' => 'ecommerce'
    ],
    [
        'name' => "Reports",
        'flag' => "ecommerce.reports",
        'parent_flag' => 'ecommerce'
    ]
];
