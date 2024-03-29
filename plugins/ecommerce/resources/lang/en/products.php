<?php

return [
    'name' => 'Product',
    'create' => 'Create',
    'forms' => [
        'name' => 'Name'
    ],
    'edit' => 'Edit',
    'form'                                 => [
        'name'                               => 'Name',
        'name_placeholder'                   => 'Product\'s name (Maximum 120 characters)',
        'description'                        => 'Description',
        'description_placeholder'            => 'Short description for product (Maximum 400 characters)',
        'categories'                         => 'Categories',
        'content'                            => 'Content',
        'price'                              => 'Price',
        'quantity'                           => 'Quantity',
        'brand'                              => 'Brand',
        'width'                              => 'Width',
        'height'                             => 'Height',
        'weight'                             => 'Weight',
        'date'                               => [
            'end'   => 'From date',
            'start' => 'To date',
        ],
        'image'                              => 'Images',
        'label'                              => 'Product collections',
        'price_sale'                         => 'Price sale',
        'product_type'                       => [
            'title' => 'Product type',
        ],
        'product'                            => 'Product',
        'total'                              => 'Total amount',
        'sub_total'                          => 'Subtotal',
        'shipping_fee'                       => 'Shipping fee',
        'discount'                           => 'Discount',
        'options'                            => 'Options',
        'shipping'                           => [
            'height' => 'Height',
            'length' => 'Length',
            'title'  => 'Shipping',
            'weight' => 'Weight',
            'wide'   => 'Wide',
        ],
        'stock'                              => [
            'allow_order_when_out' => 'Allow customer checkout when this product out of stock',
            'in_stock'             => 'In stock',
            'out_stock'            => 'Out stock',
            'title'                => 'Stock status',
        ],
        'storehouse'                         => [
            'no_storehouse' => 'No storehouse management',
            'storehouse'    => 'With storehouse management',
            'title'         => 'Storehouse',
            'quantity'      => 'Quantity',
        ],
        'tax'                                => 'Tax',
        'is_default'                         => 'Is default',
        'action'                             => 'Action',
        'restock_quantity'                   => 'Restock quantity',
        'remain'                             => 'Remain',
        'choose_discount_period'             => 'Choose Discount Period',
        'cancel'                             => 'Cancel',
        'no_results'                         => 'No results!',
        'value'                              => 'Value',
        'attribute_name'                     => 'Attribute name',
        'add_more_attribute'                 => 'Add more attribute',
        'continue'                           => 'Continue',
        'add_new_attributes'                 => 'Add new attributes',
        'add_new_attributes_description'     => 'Adding new attributes helps the product to have many options, such as size or color.',
        'create_product_variations'          => ':link to create product variations!',
        'tags'                               => 'Tags',
        'write_some_tags'                    => 'Write some tags',
        'variation_existed'                  => 'This variation is existed.',
        'no_attributes_selected'             => 'No attributes selected!',
        'added_variation_success'            => 'Added variation successfully!',
        'updated_variation_success'          => 'Updated variation successfully!',
        'created_all_variation_success'      => 'Created all variations successfully!',
        'updated_product_attributes_success' => 'Updated product attributes successfully!',
    ],
];