<?php

namespace Ocart\Ecommerce\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Enums\OrderStatusEnum;
use Ocart\Ecommerce\Enums\ShippingMethodEnum;
use Ocart\Ecommerce\Http\Requests\CheckoutRequest;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderAddressRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderHistoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Payment\Facades\Payment;
use Ocart\Payment\Repositories\PaymentRepository;
use Ocart\Theme\Facades\Theme;

class CheckoutController extends BaseController
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var OrderProductRepository
     */
    protected $orderProductRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var OrderAddressRepository
     */
    protected $orderAddressRepository;

    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var OrderHistoryRepository
     */
    protected $orderHistoryRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderAddressRepository $orderAddressRepository,
        OrderProductRepository $orderProductRepository,
        OrderHistoryRepository $orderHistoryRepository,
        PaymentRepository $paymentRepository,
        CustomerRepository $customerRepository,
        ProductRepository $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderAddressRepository = $orderAddressRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->productRepository = $productRepository;
        $this->paymentRepository = $paymentRepository;
        $this->customerRepository = $customerRepository;
        $this->orderHistoryRepository = $orderHistoryRepository;
    }

    public function getCheckout()
    {
        $cart = get_cart_content();

        return Theme::scope('shopping-buy', compact('cart'), 'packages/ecommerce::shopping-buy');
    }

    public function postCheckout(CheckoutRequest $request, BaseHttpResponse $response)
    {
        $products = get_cart_content();

        DB::beginTransaction();

        $data = [
            'amount' => get_cart_pricetotal(),
            'currency_id' => get_application_currency_id(),
            'user_id' => 0,
            'shipping_method' => ShippingMethodEnum::DEFAULT,
            'shipping_option' => '',
            'shipping_amount' => 0,
            'tax_amount' => 0,
            'sub_total' => get_cart_subtotal(),
            'coupon_code' => '',
            'discount_amount' => 0,
            'discount_description' => '',
            'description' => '',
            'is_confirmed' => 1,
            'status' => OrderStatusEnum::PROCESSING,
        ];

        $order = $this->orderRepository->create($data);

        if ($order) {
            $request->merge([
                'order_id' => $order->id,
                'amount'   => $data['amount'],
                'currency' => $data['currency_id']
            ]);

            $this->orderHistoryRepository->create([
                'action' => 'create_order_from_payment_page',
                'description' => __('Order is created from checkout page'),
                'order_id' => $order->id,
            ]);

            $this->orderHistoryRepository->create([
                'action' => 'create_order',
                'description' => trans('plugins/ecommerce::orders.new_order_from',
                    [
                        'order_id' => $order->code,
                        'customer' => $order->user->name
                    ]),
                'order_id' => $order->id,
            ]);

            if ($order->description) {
                $this->orderHistoryRepository->create([
                    'action' => 'added_note',
                    'description' => '%user_name% added a note to this order',
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'extras' => json_encode(['note' => $order->description])
                ]);
            }

            if ($payment_method = $request->input('payment_method')) {
                $result = Payment::driver($payment_method)->execute($request);

                $payment = $this->paymentRepository->findByField('charge_id', $result)->first();

                $order->payment_id = $payment->id;
            }

            $order->save();

            $this->orderAddressRepository->create(
                $request->only(['name', 'phone', 'email', 'address']) + ['order_id' => $order->id]
            );

            foreach ($products as $productItem) {
                $product = $this->productRepository->findByField('id', Arr::get($productItem, 'id'))->first();
                if (!$product) {
                    continue;
                }

                $data = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'qty' => Arr::get($productItem, 'qty', 1),
                    'weight' => $product->weight,
                    'price' => $product->price,
                    'tax_amount' => 0,
                    'options' => [],
                ];

                $this->orderProductRepository->create($data);

            }

            DB::commit();

            destroy_to_cart();
        }

        return $response->setData($order);
    }
}