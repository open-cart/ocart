<?php


namespace Ocart\Ecommerce\Http\Controllers\Customers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\TagForm;
use Ocart\Ecommerce\Http\Requests\AddCustomerWhenCreateOrderRequest;
use Ocart\Ecommerce\Http\Requests\TagRequest;
use Ocart\Ecommerce\Repositories\Criteria\CustomerSearchCriteria;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerAddressRepository;
use Ocart\Ecommerce\Repositories\Interfaces\CustomerRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Table\TagTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class CustomerController extends BaseController
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    protected $addressRepository;

    public function __construct(CustomerRepository $customerRepository, CustomerAddressRepository $addressRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->authorizeResource($customerRepository->getModel(), 'id');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'ecommerce.customers.index',
            'show' => 'ecommerce.customers.update',
            'create' => 'ecommerce.customers.create',
            'store' => 'ecommerce.customers.create',
            'edit' => 'ecommerce.customers.update',
            'update' => 'ecommerce.customers.update',
            'destroy' => 'ecommerce.customers.destroy',
        ];
    }

    public function index(TagTable $table)
    {
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tags.create'));

        return $formBuilder->create(TagForm::class)
            ->setMethod('POST')
            ->setUrl(route('ecommerce.tags.store'))
            ->renderForm();
    }

    function store(TagRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->customerRepository->create($data + [
                'author_id' => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('ecommerce.tags.index'))
            ->setNextUrl(route('ecommerce.tags.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tags.edit'));
        $page = $this->customerRepository->skipCriteria()->find($id);

        return $formBuilder->create(TagForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.tags.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, TagRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->customerRepository->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('ecommerce.tags.index'))
            ->setNextUrl(route('ecommerce.tags.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->customerRepository->delete($request->input('id'));

        return response()->json([]);
    }

    public function getSearchCustomers()
    {
        $customers = $this->customerRepository
            ->pushCriteria(CustomerSearchCriteria::class)
            ->paginate(5);

        return view('plugins.ecommerce::customers.get-search-customers', compact('customers'));
    }

    public function getCustomerAddresses(Request $request, BaseHttpResponse $response)
    {
        $addresses = $this->addressRepository->findByField('customer_id', $request->input('id'));

        return $response->setData($addresses);
    }

    public function postCreateCustomerWhenCreatingOrder(
        AddCustomerWhenCreateOrderRequest $request,
        BaseHttpResponse $response
    ) {
        DB::beginTransaction();

        $request->merge(['password' => Hash::make(time())]);
        $customer = $this->customerRepository->create($request->input());
        $customer->avatar = (string)$customer->avatar_url;

        $request->merge([
            'customer_id' => $customer->id,
            'is_default'  => true,
        ]);

        $address = $this->addressRepository->create($request->input());

        DB::commit();

        return $response
            ->setData(compact('address', 'customer'))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }
}
