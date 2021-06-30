<?php

return [
    'setting' => [
        'separator_comma' => 'Comma (,)',
        'separator_period' => 'Period (.)',
        'separator_space' => 'Space ( )',
        'thousands_separator' => 'Thousands separator',
        'decimal_separator' => 'Decimal separator',

        'other_settings' => 'Other settings',
        'other_setting_descriptions' => 'Other settings description',

        'enable_cart' => 'Enable cart',
        'enable_tax' => 'Enable tax',
    ],
    'list_order' => 'Danh sách đơn hàng',
    'statuses'                            => [
        'pending'    => 'Chưa xử lý',
        'processing' => 'Đang xử lý',
        'delivering' => 'Đang giao hàng',
        'delivered'  => 'Đã giao hàng',
        'completed'  => 'Hoàn thành',
        'canceled'   => 'Bị huỷ',
        'default'    => 'Mặc định'
    ],
    'categories' => 'Danh mục sản phẩm',
    'brand' => 'Brand',

    'settings' => [
        'email' => [
            'title' => 'Ecommerce',
            'description' => 'Config email templates for Ecommerce',
            'customer_new_order_title' => 'Xác nhận đơn hàng',
            'customer_new_order_description' => 'Gửi email xác nhận cho khách hàng khi đặt hàng.',

            'customer_cancel_order_title'       => 'Hủy đơn hàng',
            'customer_cancel_order_description' => 'Send to custom when they cancelled order',

            'delivery_order_title'       => 'Xác nhận giao hàng',
            'delivery_order_description' => 'Gửi cho khách hàng khi đơn hàng đang được giao.',

            'admin_new_order_title'       => 'Thông báo về đơn đặt hàng mới',
            'admin_new_order_description' => 'Gửi cho quản trị viên khi có đơn đặt hàng',

            'order_confirm_title'       => 'Order confirmation',
            'order_confirm_description' => 'Send to customer when they order was confirmed by admins',

            'order_confirm_payment_title'       => 'Payment confirmation',
            'order_confirm_payment_description' => 'Send to customer when their payment was confirmed',

            'order_recover_title'       => 'Incomplete order',
            'order_recover_description' => 'Send to custom to remind them about incomplete orders',
        ]
    ],

    'store_address'                   => 'Địa chỉ cửa hàng',
    'store_phone'                     => 'Số điện thoại cửa hàng',
    'order_id'                        => 'Mã đơn hàng',
    'order_token'                     => 'Chuỗi mã hoá đơn hàng',
    'customer_name'                   => 'Tên khách hàng',
    'customer_email'                  => 'Email khách hàng',
    'customer_phone'                  => 'Số điện thoại khách hàng',
    'customer_address'                => 'Địa chỉ khách hàng',
    'product_list'                    => 'Danh sách sản phẩm trong đơn hàng',
    'payment_detail'                  => 'Chi tiết thanh toán',
    'shipping_method'                 => 'Phương thức vận chuyển',
    'payment_method'                  => 'Phương thức thanh toán',
    'standard_and_format'             => 'Tiêu chuẩn & Định dạng',
    'standard_and_format_description' => 'Các tiêu chuẩn và các định dạng được sử dụng để tính toán những thứ như giá cả sản phẩm, trọng lượng vận chuyển và thời gian đơn hàng được đặt.',
    'change_order_format'             => 'Chỉnh sửa định dạng mã đơn hàng (tùy chọn)',
    'change_order_format_description' => 'Mã đơn hàng mặc định bắt đầu từ :number. Bạn có thể thay đổi chuỗi bắt đầu hoặc kết thúc để tạo mã đơn hàng theo ý bạn, ví dụ "DH-:number" hoặc ":number-A"',
    'start_with'                      => 'Bắt đầu bằng',
    'end_with'                        => 'Kết thúc bằng',
    'order_will_be_shown'             => 'Mã đơn hàng của bạn sẽ hiển thị theo mẫu',
    'weight_unit'                     => 'Đơn vị cân nặng',
    'height_unit'                     => 'Đơn vị chiều dài/chiều cao',
];