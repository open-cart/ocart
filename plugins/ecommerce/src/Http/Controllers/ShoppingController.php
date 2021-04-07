<?php


namespace Ocart\Ecommerce\Http\Controllers;

use Ocart\Theme\Facades\Theme;
use Illuminate\Http\Request;


class ShoppingController
{
    public function cart()
    {
        $cart = get_cart_content();

        return Theme::scope('shopping-cart', compact('cart'),'packages/ecommerce::shopping-cart');
    }

    public function buy()
    {
        $cart = get_cart_content();

        return Theme::scope('shopping-buy', compact('cart'),'packages/ecommerce::shopping-buy');
    }

    public function thank()
    {
        return Theme::scope('shopping-thank','packages/ecommerce::shopping-thank');
    }

    public function add(Request $request)
    {
        $params = $request->all();
        if (!empty($params)) {
            $data       = $params['data'];
        }
        add_to_cart($data);
        return json_encode(['status' => 1, 'data' => $data, 'messenge' => "Thêm sản phẩm thành công"]);
    }

    public function remove(Request $request)
    {
        $params = $request->all();
        if (!empty($params)) {
            $rowID       = $params['rowId'];
        }
        remove_to_cart($rowID);
        return json_encode(['status' => 1, 'data' => $rowID, 'messenge' => "Xóa sản phẩm khỏi giỏ hàng thành công."]);

    }
}
