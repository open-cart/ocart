<?php


namespace Ocart\Ecommerce\Http\Controllers;

use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Theme\Facades\Theme;
use Illuminate\Http\Request;


class ShoppingController
{
    protected $repo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repo = $productRepository;
    }

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
        return Theme::scope('shopping-thank');
    }

    public function add(Request $request)
    {
        $params = $request->all();
        if (!empty($params)) {
            $productId       = $params['productId'];
        }

        $product = $this->repo->with('categories')->find($productId);

        add_to_cart($product);
        $cart_count = get_cart_count();
        return json_encode(['status' => 1, 'data' => $product, 'count' => $cart_count, 'message' => "Thêm sản phẩm thành công"]);
    }

    public function remove(Request $request)
    {
        $params = $request->all();
        if (!empty($params)) {
            $rowID       = $params['rowId'];
        }
        remove_to_cart($rowID);
        $cart_count = get_cart_count();
        return json_encode(['status' => 1, 'data' => $rowID, 'count' => $cart_count, 'message' => "Xóa sản phẩm khỏi giỏ hàng thành công."]);

    }

    public function update(Request $request)
    {
        $params = $request->all();
        if (!empty($params)) {
            $rowID       = $params['rowId'];
            $qty       = $params['qty'];
        }
        update_to_cart($rowID, $qty);
        $cart_count = get_cart_count();
        return json_encode(['status' => 1, 'data' => $rowID, 'count' => $cart_count, 'message' => "Cập nhật giỏ hàng thành công."]);

    }
}
