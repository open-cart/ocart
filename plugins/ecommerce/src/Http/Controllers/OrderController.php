<?php
namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Core\Facades\EmailHandler;
use Ocart\Ecommerce\Enums\OrderStatusEnum;
use Ocart\Ecommerce\Enums\ShippingMethodEnum;
use Ocart\Ecommerce\Facades\OrderHelper;
use Ocart\Ecommerce\Forms\BrandForm;
use Ocart\Ecommerce\Http\Requests\AddressRequest;
use Ocart\Ecommerce\Http\Requests\BrandRequest;
use Ocart\Ecommerce\Http\Requests\CreateShipmentRequest;
use Ocart\Ecommerce\Http\Requests\OrderCommentRequest;
use Ocart\Ecommerce\Http\Requests\OrderCreateRequest;
use Ocart\Ecommerce\Http\Requests\OrderUpdateRequest;
use Ocart\Ecommerce\Http\Requests\RefundRequest;
use Ocart\Ecommerce\Models\Order;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderAddressRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderHistoryRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Services\HandleShippingFeeService;
use Ocart\Ecommerce\Table\BrandTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Table\OrderTable;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Enums\PaymentStatusEnum;
use Ocart\Payment\Models\Payment;
use Ocart\Payment\Repositories\PaymentRepository;

class OrderController extends BaseController
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

        $this->authorizeResource($orderRepository->getModel(), 'id');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'ecommerce.orders.index',
            'show' => 'ecommerce.orders.update',
            'create' => 'ecommerce.orders.create',
            'store' => 'ecommerce.orders.create',
            'edit' => 'ecommerce.orders.update',
            'update' => 'ecommerce.orders.update',
            'destroy' => 'ecommerce.orders.destroy',
        ];
    }

    public function index(OrderTable $table)
    {
        page_title()->setTitle(trans('plugins/ecommerce::ecommerce.list_order'));
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::orders.create'));

        return view('plugins.ecommerce::orders.create');
    }

    function store(OrderCreateRequest $request, BaseHttpResponse $response)
    {
        DB::beginTransaction();

        $amount = $request->get('amount');
        $tax_amount = $request->get('tax_amount', 0);
        $shipping_amount = $request->get('shipping_amount');
        $discount_amount = $request->get('discount_amount');

        $data = [
            'amount'               => $amount + $shipping_amount - $discount_amount + $tax_amount,
            'tax_amount'           => $tax_amount,
            'currency_id'          => get_application_currency_id(),
            'user_id'              => $request->input('customer_id') ?? 0,
            'shipping_method'      => $request->input('shipping_method', ShippingMethodEnum::DEFAULT),
            'shipping_option'      => $request->input('shipping_option'),
            'shipping_amount'      => $request->input('shipping_amount'),
            'sub_total'            => $request->input('amount'),
            'coupon_code'          => $request->input('coupon_code'),
            'discount_amount'      => $request->input('discount_amount'),
            'discount_description' => $request->input('discount_description'),
            'description'          => $request->input('note'),
            'is_confirmed'         => 1,
            'status'               => OrderStatusEnum::PROCESSING,
        ];

        $order = $this->orderRepository->create($data);

        if ($order) {
            $this->orderHistoryRepository->create([
                'action'      => 'create_order_from_payment_page',
                'description' => trans('plugins/ecommerce::orders.create_order_from_payment_page'),
                'order_id'    => $order->id,
            ]);

            $this->orderHistoryRepository->create([
                'action'      => 'create_order',
                'description' => trans('plugins/ecommerce::orders.new_order',
                    ['order_id' => $order->code]),
                'order_id'    => $order->id,
            ]);

            $this->orderHistoryRepository->create([
                'action'      => 'confirm_order',
                'description' => trans('plugins/ecommerce::orders.order_was_verified_by'),
                'order_id'    => $order->id,
                'user_id'     => Auth::user()->getKey(),
            ]);

            if ($order->description) {
                $this->orderHistoryRepository->create([
                    'action'      => 'added_note',
                    'description' => '%user_name% added a note to this order',
                    'order_id'    => $order->id,
                    'user_id'     => \Auth::user()->getKey(),
                    'extras' => json_encode(['note' => $order->description])
                ]);
            }

            $payment = $this->paymentRepository->create([
                'amount'          => $order->amount,
                'currency'        => get_application_currency()->title,
                'payment_channel' => $request->input('payment_method'),
                'status'          => $request->input('payment_status', PaymentStatusEnum::PENDING) ?: PaymentStatusEnum::PENDING,
                'payment_type'    => 'confirm',
                'order_id'        => $order->id,
                'charge_id'       => Str::upper(Str::random(10)),
                'user_id'         => Auth::user()->getAuthIdentifier(),
            ]);

            $order->payment_id = $payment->id;
            $order->save();

            if ($request->input('payment_status') === PaymentStatusEnum::COMPLETED) {
                $this->orderHistoryRepository->create([
                    'action'      => 'confirm_payment',
                    'description' => trans('plugins/ecommerce::orders.payment_was_confirmed_by', [
                        'money' => format_price($order->amount, $order->currency_id),
                    ]),
                    'order_id'    => $order->id,
                    'user_id'     => Auth::user()->getKey(),
                ]);
            }

            if ($request->input('customer_address.name')) {
                $this->orderAddressRepository->create([
                    'name'     => $request->input('customer_address.name'),
                    'phone'    => $request->input('customer_address.phone'),
                    'email'    => $request->input('customer_address.email'),
                    'state'    => $request->input('customer_address.state'),
                    'city'     => $request->input('customer_address.city'),
                    'zip_code' => $request->input('customer_address.zip_code'),
                    'country'  => $request->input('customer_address.country'),
                    'address'  => $request->input('customer_address.address'),
                    'order_id' => $order->id,
                ]);
            } else if ($request->input('customer_id')) {
                $customer = $this->customerRepository->findByField('id', $request->input('customer_id'))->first();
                $this->orderAddressRepository->create([
                    'name'     => $customer->name,
                    'phone'    => $customer->phone,
                    'email'    => $customer->email,
                    'order_id' => $order->id,
                    'address'  => ''
                ]);
            }

            foreach ($request->input('products', []) as $productItem) {
                $product = $this->productRepository->findByField('id', Arr::get($productItem, 'id'))->first();
                if (!$product) {
                    continue;
                }

                $data = [
                    'order_id'     => $order->id,
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'qty'          => Arr::get($productItem, 'qty', 1),
                    'weight'       => $product->weight,
                    'price'        => $product->sell_price,
                    'tax_amount'   => $product->sell_price_with_taxes - $product->sell_price,
                    'options'      => [],
                ];

                $this->orderProductRepository->create($data);
            }
        }

        DB::commit();

        return $response->setData($order);
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::orders.edit'));

        $order = $this->orderRepository
            ->with(['products', 'user', 'address', 'histories' => function($q) {
                return $q->orderBy('id', 'desc');
            }])
            ->skipCriteria()
            ->find($id);

        return view('plugins.ecommerce::orders.edit', compact('order'));
//        $page = $this->orderRepository->skipCriteria()->find($id);
//
//        return $formBuilder->create(BrandForm::class, ['model' => $page])
//            ->setMethod('PUT')
//            ->setUrl(route('ecommerce.brands.update', ['id' => $page->id]))
//            ->renderForm();
    }

    function update($id, OrderUpdateRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        /** @var Order $order */
        $order = $this->orderRepository->update($data, $id);

        event(new UpdatedContentEvent(ORDER_MODULE_SCREEN_NAME, $request, $order));

        return $response->setPreviousUrl(route('ecommerce.orders.index'))
            ->setNextUrl(route('ecommerce.orders.show', $order->id));
    }

    function destroy(Request $request)
    {
        $this->orderRepository->delete($request->input('id'));

        return response()->json([]);
    }

    function postConfirmOrder(Request $request, BaseHttpResponse $response)
    {
        $order = $this->orderRepository->update([
            'status' => OrderStatusEnum::PROCESSING
        ], $request->input('id'));

        $this->setEmailVariables($order);

        EmailHandler::module(ECOMMERCE_MODULE_SCREEN_NAME)
            ->sendUsingTemplate('plugins.ecommerce::emails.order_confirm',
                $order->user->email ? $order->user->email : $order->address->email);

        return $response->setMessage(trans('plugins/ecommerce::order.confirm_order_success'));
    }

    function postConfirmPayment(Request $request, BaseHttpResponse $response)
    {
        $id = $request->input('id');

        DB::beginTransaction();

        $order = $this->orderRepository->find($id);

        if ($order->status === OrderStatusEnum::PENDING) {
            $order->status = OrderStatusEnum::PROCESSING;
        }

        $order->save();

        $payment = $order->payment;

        $payment->status = PaymentStatusEnum::COMPLETED;

        $payment->save();

        $this->orderHistoryRepository->create([
            'action'      => 'confirm_payment',
            'description' => trans('plugins/ecommerce::orders.payment_was_confirmed_by', [
                'money' => format_price($order->amount, $order->currency_id),
            ]),
            'order_id'    => $order->id,
            'user_id'     => Auth::user()->getKey(),
        ]);

        $this->setEmailVariables($order);
        EmailHandler::module(ECOMMERCE_MODULE_SCREEN_NAME)
            ->sendUsingTemplate('plugins.ecommerce::emails.order_confirm_payment',
                $order->user->email ? $order->user->email : $order->address->email);

        DB::commit();

        return $response->setMessage(trans('plugins/ecommerce::orders.confirm_payment_success'));
    }

    public function postUpdateShippingAddress($id, AddressRequest $request, BaseHttpResponse $response)
    {
        $address = $this->orderAddressRepository->update($request->input(), $id);

        if (!$address) {
            abort(404);
        }

        return $response
            ->setData($address)
            ->setMessage(trans('plugins/ecommerce::orders.update_shipping_address_success'));
    }

    public function postCreateShipment(
        $id,
        CreateShipmentRequest $request,
        BaseHttpResponse $response
    ) {

    }

    /**
     * @param $id
     * @param CreateShipmentRequest $request
     * @param BaseHttpResponse $response
     */
    public function postMarkAsFulfilled(
        $id,
        CreateShipmentRequest $request,
        BaseHttpResponse $response
    ) {
        $order = $this->orderRepository->update(['status' => OrderStatusEnum::COMPLETED], $id);

        $this->setEmailVariables($order);

        EmailHandler::module(ECOMMERCE_MODULE_SCREEN_NAME)
            ->sendUsingTemplate('plugins.ecommerce::emails.delivery_order',
                $order->user->email ? $order->user->email : $order->address->email);

        $this->orderHistoryRepository->create([
            'action'      => 'create_shipment',
            'description' => trans('plugins/ecommerce::orders.order_was_sent_to_shipping_team_by_username'),
            'order_id'    => $id,
            'user_id'     => Auth::user()->getKey(),
        ]);

        return $response->setMessage(trans('successfully'));
    }

    /**
     * @deprecated buy không được dùng nữa. sử dụng checkout trong CheckoutController thay thế.
     * @return mixed
     */
    public function buy(Request $request, BaseHttpResponse $response)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|min:8|max:12',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required',
        ]);

        $params = $request->all();

        if (!empty($params)) {
            $name = $params['name'];
            $phone = $params['phone'];
            $email = $params['email'];
            $address = $params['address'];
            $products = $params['products'];
        }

        $data = [
            'amount'               => get_cart_pricetotal(),
            'currency_id'          => get_application_currency_id(),
            'user_id'              => 0,
            'shipping_method'      => ShippingMethodEnum::DEFAULT,
            'shipping_option'      => '',
            'shipping_amount'      => 0,
            'tax_amount'           => 0,
            'sub_total'            => get_cart_subtotal(),
            'coupon_code'          => '',
            'discount_amount'      => 0,
            'discount_description' => '',
            'description'          => '',
            'is_confirmed'         => 1,
            'status'               => OrderStatusEnum::PROCESSING,
        ];

        $order = $this->orderRepository->create($data);

        if ($order) {
            $this->orderHistoryRepository->create([
                'action'      => 'create_order_from_payment_page',
                'description' => __('Order is created from checkout page'),
                'order_id'    => $order->id,
            ]);

            $this->orderHistoryRepository->create([
                'action'      => 'create_order',
                'description' => trans('plugins/ecommerce::orders.new_order_from',
                    [
                        'order_id' => $order->code,
                        'customer' => $order->user->name
                    ]),
                'order_id'    => $order->id,
            ]);

            if ($order->description) {
                $this->orderHistoryRepository->create([
                    'action'      => 'added_note',
                    'description' => '%user_name% added a note to this order',
                    'order_id'    => $order->id,
                    'user_id'     => $order->user_id,
                    'extras' => json_encode(['note' => $order->description])
                ]);
            }

//            if ($request->input('payment_status') === PaymentStatusEnum::COMPLETED) {
//                $this->orderHistoryRepository->create([
//                    'action'      => 'confirm_payment',
//                    'description' => trans('plugins/ecommerce::orders.payment_was_confirmed_by', [
//                        'money' => format_price($order->amount, $order->currency_id),
//                    ]),
//                    'order_id'    => $order->id,
//                    'user_id'     => Auth::user()->getKey(),
//                ]);
//            }
//
//            $payment = $this->paymentRepository->create([
//                'amount'          => $order->amount,
//                'currency'        => get_application_currency()->title,
//                'payment_channel' => $request->input('payment_method', 'cod'),
//                'status'          => $request->input('payment_status', PaymentStatusEnum::PENDING),
//                'payment_type'    => 'confirm',
//                'order_id'        => $order->id,
//                'charge_id'       => Str::upper(Str::random(10)),
//                'user_id'         => Auth::user()->getAuthIdentifier(),
//            ]);
//
//            $order->payment_id = $payment->id;
            $order->save();

            $this->orderAddressRepository->create([
                'name'     => $name,
                'phone'    => $phone,
                'email'    => $email,
                'order_id' => $order->id,
                'address'  => $address
            ]);

            foreach ($products as $productItem) {
                $product = $this->productRepository->findByField('id', Arr::get($productItem, 'id'))->first();
                if (!$product) {
                    continue;
                }

                $data = [
                    'order_id'     => $order->id,
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'qty'          => Arr::get($productItem, 'qty', 1),
                    'weight'       => $product->weight,
                    'price'        => $product->price,
                    'tax_amount'   => 0,
                    'options'      => [],
                ];

                $this->orderProductRepository->create($data);

            }

            destroy_to_cart();

        }

        return $response->setData($order);
    }

    public function getAvailableShippingMethods(
        Request $request,
        BaseHttpResponse $response,
        HandleShippingFeeService $shippingFeeService
    )
    {

        $weight = 0;
        $orderAmount = 0;

        foreach ($request->input('products', []) as $p) {
            $product = $this->productRepository->find($p['id']);
            if ($product) {
                $weight += $product->weight;
                $orderAmount += ($product->sell_price * $p['qty']);
            }
        }

        $weight = $weight > 0.1 ? $weight : 0.1;

        $shippingData = [
            'address'     => $request->input('address'),
            'country'     => $request->input('country'),
            'state'       => $request->input('state'),
            'city'        => $request->input('city'),
            'weight'      => $weight,
            'order_total' => $orderAmount,
        ];

        $shipping = $shippingFeeService->execute($shippingData);

        $shipping[] = [
            'value' => '',
            'name' => 'Free shipping',
            'price' => '0'
        ];

        return $response->setData($shipping);
    }

    public function postComment(OrderCommentRequest $request, BaseHttpResponse $response)
    {
        $this->orderHistoryRepository->create([
            'action'      => 'comment',
            'description' => $request->comment,
            'order_id'    => $request->order_id,
            'user_id'     => Auth::user()->getAuthIdentifier(),
        ]);

        return $response->setMessage(trans('plugins/ecommerce::orders.successfully'));
    }

    public function postDeleteComment(Request $request, BaseHttpResponse $response)
    {
        $this->orderHistoryRepository->deleteWhere([
            'action'      => 'comment',
            'id'          => $request->id,
        ]);

        return $response->setMessage(trans('plugins/ecommerce::orders.successfully'));
    }

    public function postRefund($id, RefundRequest $request, BaseHttpResponse $response)
    {
        $order = $this->orderRepository->find($id);
        if ($request->input('refund_amount') > ($order->payment->amount - $order->payment->refunded_amount)) {
            return $response
                ->setError()
                ->setMessage(trans('plugins/ecommerce::orders.refund_amount_invalid', [
                    'price' => format_price($order->payment->amount - $order->payment->refunded_amount,
                        get_application_currency()),
                ]));
        }

        $hasError = false;
        foreach ($request->input('products', []) as $p) {
            $orderProduct = $this->orderProductRepository->findWhere([
                'product_id' => $p['id'],
                'order_id'   => $id,
            ])->first();

            if ($p['quantity'] > ($orderProduct->qty - $orderProduct->restock_quantity)) {
                $hasError = true;
                $response
                    ->setError()
                    ->setMessage(trans('plugins/ecommerce::orders.number_of_products_invalid'));
                break;
            }
        }

        if ($hasError) {
            return $response;
        }

        $payment = $order->payment;
        if (!$payment) {
            return $response
                ->setError()
                ->setMessage(trans('plugins/ecommerce::orders.cannot_found_payment_for_this_order'));
        }

        DB::beginTransaction();

        $payment->refunded_amount += $request->input('refund_amount');

        $payment->status = PaymentStatusEnum::REFUNDING;

        if ($payment->refunded_amount == $payment->amount) {
            $payment->status = PaymentStatusEnum::REFUNDED;
        }

        $payment->refund_note = $request->input('refund_note');
        $this->paymentRepository->update($payment->toArray(), $payment->id);

        foreach ($request->input('products', []) as $productId => $p) {
            DB::table('ecommerce_order_product')->where([
                'product_id' => $p['id'],
                'order_id'   => $id,
            ])->increment('restock_quantity', $p['quantity']);

//            $orderProduct = $this->orderProductRepository->findWhere([
//                'product_id' => $productId,
//                'order_id'   => $id,
//            ])->first();
//
//            if ($orderProduct) {
//                $orderProduct->restock_quantity += $quantity;
//                $this->orderProductRepository->update($orderProduct->toArray(), $orderProduct->id);
//            }
        }

        if ($request->input('refund_amount', 0) > 0) {
            $this->orderHistoryRepository->create([
                'action'      => 'refund',
                'description' => trans('plugins/ecommerce::orders.refund_success_with_price', [
                    'price' => format_price($request->input('refund_amount')),
                ]),
                'order_id'    => $order->id,
                'user_id'     => Auth::user()->getKey(),
                'extras'      => json_encode([
                    'amount' => $request->input('refund_amount'),
                    'method' => $payment->payment_channel ?? PaymentMethodEnum::COD,
                ]),
            ]);
        }

        DB::commit();

        return $response->setMessage(trans('plugins/ecommerce::orders.refund_success'));
    }

    public function postCancelOrder($id, BaseHttpResponse $response)
    {
        $order = $this->orderRepository->update(['status' => OrderStatusEnum::CANCELED, 'is_confirmed' => true], $id);

        $this->orderHistoryRepository->create([
            'action'      => 'cancel_order',
            'description' => trans('plugins/ecommerce::orders.order_was_canceled_by'),
            'order_id'    => $order->id,
            'user_id'     => Auth::user()->getKey(),
        ]);

        $this->setEmailVariables($order);
        EmailHandler::module(ECOMMERCE_MODULE_SCREEN_NAME)
            ->sendUsingTemplate('plugins.ecommerce::emails.customer_cancel_order',
                $order->user->email ? $order->user->email : $order->address->email
            );

        return $response->setMessage(trans('plugins/ecommerce::orders.customer.messages.cancel_success'));
    }

    protected function setEmailVariables($order)
    {
        EmailHandler::module(ECOMMERCE_MODULE_SCREEN_NAME)->setVariableValues([
            'store_address'    => get_ecommerce_setting('store_address'),
            'store_phone'      => get_ecommerce_setting('store_phone'),
            'order_id'         => str_replace('#', '', $order->code),
            'order_token'      => $order->token,
            'customer_name'    => $order->user->name ? $order->user->name : $order->address->name,
            'customer_email'   => $order->user->email ? $order->user->email : $order->address->email,
            'customer_phone'   => $order->user->phone ? $order->user->phone : $order->address->phone,
            'customer_address' => $order->address->address . ', ' . $order->address->city . ', ' . $order->address->country_name,
            'product_list'     => view('plugins.ecommerce::emails.partials.order-detail',
                compact('order'))->render(),
            'shipping_method'  => $order->shipping_method_name,
            'payment_method'   => $order->payment->payment_channel->label(),
        ]);
    }

    /**
     * @param int $orderId
     */
    public function getGenerateInvoice($orderId)
    {
        $order = $this->orderRepository->find($orderId);

//        return view('plugins.ecommerce::invoices.template', compact('order'));
//
        return OrderHelper::generateInvoice($order);

//        return response()->file($in);
    }
}
