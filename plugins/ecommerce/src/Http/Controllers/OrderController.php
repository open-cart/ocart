<?php
namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Enums\OrderStatusEnum;
use Ocart\Ecommerce\Enums\ShippingMethodEnum;
use Ocart\Ecommerce\Forms\BrandForm;
use Ocart\Ecommerce\Http\Requests\BrandRequest;
use Ocart\Ecommerce\Http\Requests\OrderCreateRequest;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderProductRepository;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Table\BrandTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Table\OrderTable;

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

    public function __construct(
        OrderRepository $repo,
        OrderProductRepository $orderProductRepository,
        ProductRepository $productRepository
    )
    {
        $this->repo = $repo;
        $this->orderProductRepository = $orderProductRepository;
        $this->productRepository = $productRepository;

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

        return $response->setPreviousUrl(route('ecommerce.brands.index'))
            ->setNextUrl(route('ecommerce.brands.show', $order->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::brands.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(BrandForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.brands.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, BrandRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('ecommerce.brands.index'))
            ->setNextUrl(route('ecommerce.brands.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
