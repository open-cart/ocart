<?php
namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Ecommerce\Enums\OrderStatusEnum;
use Ocart\Ecommerce\Enums\ShippingMethodEnum;
use Ocart\Ecommerce\Forms\BrandForm;
use Ocart\Ecommerce\Http\Requests\AddressRequest;
use Ocart\Ecommerce\Http\Requests\BrandRequest;
use Ocart\Ecommerce\Http\Requests\CreateShipmentRequest;
use Ocart\Ecommerce\Http\Requests\OrderCreateRequest;
use Ocart\Ecommerce\Http\Requests\OrderUpdateRequest;
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
use Ocart\Payment\Enums\PaymentStatusEnum;
use Ocart\Payment\Repositories\PaymentRepository;

class OrderController extends BaseController
{
    /**
     * @var OrderRepository
     */
    protected $repo;

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
        OrderRepository $repo,
        OrderAddressRepository $orderAddressRepository,
        OrderProductRepository $orderProductRepository,
        OrderHistoryRepository $orderHistoryRepository,
        PaymentRepository $paymentRepository,
        CustomerRepository $customerRepository,
        ProductRepository $productRepository
    )
    {
        $this->repo = $repo;
        $this->orderAddressRepository = $orderAddressRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->productRepository = $productRepository;
        $this->paymentRepository = $paymentRepository;
        $this->customerRepository = $customerRepository;
        $this->orderHistoryRepository = $orderHistoryRepository;

        $this->authorizeResource($repo->getModel(), 'id');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'ecommerce.brands.index',
            'show' => 'ecommerce.brands.update',
            'create' => 'ecommerce.brands.create',
            'store' => 'ecommerce.brands.create',
            'edit' => 'ecommerce.brands.update',
            'update' => 'ecommerce.brands.update',
            'destroy' => 'ecommerce.brands.destroy',
        ];
    }

    public function index(OrderTable $table)
    {
        page_title()->setTitle(trans('plugins/ecommerce::ecommerce.list_order'));
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::brands.create'));

        return view('plugins.ecommerce::orders.create');
    }

    function store(OrderCreateRequest $request, BaseHttpResponse $response)
    {
        DB::beginTransaction();

        $data = [
            'amount'               => $request->input('amount') + $request->input('shipping_amount') - $request->input('discount_amount'),
            'currency_id'          => get_application_currency_id(),
            'user_id'              => $request->input('customer_id') ?? 0,
            'shipping_method'      => $request->input('shipping_method', ShippingMethodEnum::DEFAULT),
            'shipping_option'      => $request->input('shipping_option'),
            'shipping_amount'      => $request->input('shipping_amount'),
            'tax_amount'           => session('tax_amount', 0),
            'sub_total'            => $request->input('amount'),
            'coupon_code'          => $request->input('coupon_code'),
            'discount_amount'      => $request->input('discount_amount'),
            'discount_description' => $request->input('discount_description'),
            'description'          => $request->input('note'),
            'is_confirmed'         => 1,
            'status'               => OrderStatusEnum::PROCESSING,
        ];

        $order = $this->repo->create($data);

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
                ]);
            }

            $payment = $this->paymentRepository->create([
                'amount'          => $order->amount,
                'currency'        => get_application_currency()->title,
                'payment_channel' => $request->input('payment_method'),
                'status'          => $request->input('payment_status', PaymentStatusEnum::PENDING),
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
                    'price'        => $product->price,
                    'tax_amount'   => 0,
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
        page_title()->setTitle(trans('plugins/ecommerce::brands.edit'));

        $order = $this->repo
            ->with(['products', 'user', 'address', 'histories' => function($q) {
                return $q->orderBy('id', 'desc');
            }])
            ->skipCriteria()
            ->find($id);

        return view('plugins.ecommerce::orders.edit', compact('order'));
//        $page = $this->repo->skipCriteria()->find($id);
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
        $order = $this->repo->update($data, $id);

        event(new UpdatedContentEvent(ORDER_MODULE_SCREEN_NAME, $request, $order));

        return $response->setPreviousUrl(route('ecommerce.orders.index'))
            ->setNextUrl(route('ecommerce.orders.show', $order->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }

    function postConfirmOrder(Request $request, BaseHttpResponse $response)
    {
        $order = $this->repo->update([
            'is_confirmed' => 1
        ], $request->input('id'));

        return $response->setMessage('success');
    }

    function postConfirmPayment(Request $request, BaseHttpResponse $response)
    {
        $id = $request->input('id');

        DB::beginTransaction();

        $order = $this->repo->find($id);

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

        DB::commit();

        return $response->setMessage('successfully');
    }

    public function postUpdateShippingAddress($id, AddressRequest $request, BaseHttpResponse $response)
    {
        $address = $this->orderAddressRepository->update($request->input(), $id);

        if (!$address) {
            abort(404);
        }

        return $response
            ->setData($address)
            ->setMessage(trans('plugins/ecommerce::order.update_shipping_address_success'));
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
        $this->repo->update(['status' => OrderStatusEnum::COMPLETED], $id);

        $this->orderHistoryRepository->create([
            'action'      => 'create_shipment',
            'description' => trans('plugins/ecommerce::orders.order_was_sent_to_shipping_team_by_username'),
            'order_id'    => $id,
            'user_id'     => Auth::user()->getKey(),
        ]);

        return $response->setMessage('successfully');
    }

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

        $order = $this->repo->create($data);

        if ($order) {

            $payment = $this->paymentRepository->create([
                'amount'          => $order->amount,
                'currency'        => get_application_currency()->title,
                'payment_channel' => $request->input('payment_method', 'cod'),
                'status'          => $request->input('payment_status', PaymentStatusEnum::PENDING),
                'payment_type'    => 'confirm',
                'order_id'        => $order->id,
                'charge_id'       => Str::upper(Str::random(10)),
                'user_id'         => Auth::user()->getAuthIdentifier(),
            ]);

            $order->payment_id = $payment->id;
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

    public function postComment(Request $request, BaseHttpResponse $response)
    {
        $this->orderHistoryRepository->create([
            'action'      => 'comment',
            'description' => $request->comment,
            'order_id'    => $request->order_id,
            'user_id'     => Auth::user()->getAuthIdentifier(),
        ]);

        return $response->setMessage('successfully');
    }
}
