<?php

return [
    'create' => 'Tạo mới sản phẩm',
    'forms' => [
        'name' => 'Tên'
    ],
    'edit' => 'Sửa sản phẩm',
    'form'                        => [
        'name'                    => 'Tên sản phẩm',
        'name_placeholder'        => 'Tên sản phẩm (Tối đa 120 chữ cái)',
        'description'             => 'Mô tả ngắn',
        'description_placeholder' => 'Mô tả ngắn gọn cho sản phẩm (Tối đa 400 chữ cái)',
        'categories'              => 'Danh mục',
        'content'                 => 'Chi tiết sản phẩm',
        'price'                   => 'Giá cơ bản',
        'price_sale'              => 'Giá giảm',
        'quantity'                => 'Số lượng',
        'brand'                   => 'Thương hiệu',
        'width'                   => 'Rộng',
        'height'                  => 'Cao',
        'weight'                  => 'Cân nặng',
        'image'                   => 'Hình ảnh',
        'label'                   => 'Nhóm sản phẩm',
        'product_type'            => [
            'title' => 'Loại sản phẩm',
        ],
        'stock'                   => [
            'title'                => 'Tình trạng kho',
            'in_stock'             => 'Còn hàng',
            'out_stock'            => 'Hết hàng',
            'allow_order_when_out' => 'Cho phép đặt hàng khi hết',
        ],
        'storehouse'              => [
            'title'         => 'Quản lý kho',
            'no_storehouse' => 'Không quản lý kho',
            'storehouse'    => 'Quản lý kho',
            'quantity'      => 'Số lượng',
        ],
        'shipping'                => [
            'title'  => 'Giao hàng',
            'length' => 'Chiều dài',
            'wide'   => 'Chiều rộng',
            'height' => 'Chiều cao',
            'weight' => 'Cân nặng',
        ],
        'date'                    => [
            'start' => 'Ngày bắt đầu',
            'end'   => 'Ngày kết thúc',
        ],
        'tags'                    => 'Nhãn',
        'tax'                     => 'Thuế',
    ],
];
