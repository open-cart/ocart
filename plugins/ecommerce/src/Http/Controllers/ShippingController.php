<?php


namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\TagForm;
use Ocart\Ecommerce\Http\Requests\TagRequest;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRepository;
use Ocart\Ecommerce\Repositories\Interfaces\ShippingRuleRepository;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Table\TagTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class ShippingController extends BaseController
{
    /**
     * @var ShippingRepository
     */
    protected $shippingRepository;

    /**
     * @var ShippingRuleRepository
     */
    protected $shippingRuleRepository;

    public function __construct(ShippingRepository $shippingRepository, ShippingRuleRepository $shippingRuleRepository)
    {
        $this->shippingRepository = $shippingRepository;
        $this->shippingRuleRepository = $shippingRuleRepository;

        $this->authorizeResource($shippingRepository->getModel(), 'id');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
//            'index' => 'ecommerce.tags.index',
//            'show' => 'ecommerce.tags.update',
//            'create' => 'ecommerce.tags.create',
//            'store' => 'ecommerce.tags.create',
//            'edit' => 'ecommerce.tags.update',
//            'update' => 'ecommerce.tags.update',
//            'destroy' => 'ecommerce.tags.destroy',
        ];
    }

    public function index()
    {
        page_title()->setTitle(trans('plugins/ecommerce::shipping.shipping_methods'));
        $shippings = $this->shippingRepository->with('rules')->all();

        return view('plugins.ecommerce::shipping.methods', compact('shippings'));
    }

    function addShippingRegion(Request $request, BaseHttpResponse $response)
    {
        $countries = \Ocart\Core\Library\Helper::countries();

        $countryTitle = Arr::get($countries, $request->input('country', '') ?: '');

        $shipping = null;

        \DB::beginTransaction();

        if (!$countryTitle) {
            $shipping= $this->shippingRepository->create([
                'title' => 'All',
                'country' => null
            ]);
        } else {
            $shipping = $this->shippingRepository->create([
                'title' => $countryTitle,
                'country' => $request->country
            ]);
        }

        $this->shippingRuleRepository->create([
            'shipping_id' => $shipping->id,
            'name'          => 'Default',
            'type'          => 'base_on_price',
            'from'          => '0',
            'to'            => null,
            'price'         => 0
        ]);


        \DB::commit();

        return $response->setMessage(__('successfully'));
    }

    function deleteShippingRegion(Request $request, BaseHttpResponse $response)
    {
        \DB::beginTransaction();

        $this->shippingRuleRepository->deleteWhere([
            'shipping_id' => $request->input('id')
        ]);

        $this->shippingRepository->delete($request->input('id'));

        \DB::commit();

        return $response->setMessage(__('successfully'));
    }

    function addShippingRule(Request $request, BaseHttpResponse $response)
    {
        $this->shippingRuleRepository->create([
            'shipping_id'   => $request->input('shipping_id'),
            'name'          => $request->input('name'),
            'type'          => 'base_on_price',
            'from'          => $request->input('from', 0),
            'to'            => $request->input('to', null),
            'price'         => $request->input('price', 0),
        ]);

        return $response->setMessage(__('successfully'));
    }

    function updateShippingRule(Request $request, BaseHttpResponse $response)
    {
        $this->shippingRuleRepository->update([
            'shipping_id'   => $request->input('shipping_id'),
            'name'          => $request->input('name'),
            'type'          => 'base_on_price',
            'from'          => $request->input('from', 0),
            'to'            => $request->input('to', null),
            'price'         => $request->input('price', 0),
        ], $request->input('id', 0));

        return $response->setMessage(__('successfully'));
    }

    function deleteShippingRule(Request $request, BaseHttpResponse $response)
    {
        $rule = $this->shippingRuleRepository->find($request->input('id'));

        $this->shippingRuleRepository->delete($request->input('id'));

        $rules  = $this->shippingRuleRepository->findByField('shipping_id', $rule->shipping_id);

        if ($rules->isEmpty()) {
            $this->shippingRepository->delete($rule->shipping_id);
        }

        return $response->setMessage(__('successfully'));
    }
}
