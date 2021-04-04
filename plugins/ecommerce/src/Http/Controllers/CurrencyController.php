<?php
namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\BrandForm;
use Ocart\Ecommerce\Forms\CurrencyForm;
use Ocart\Ecommerce\Http\Requests\CurrencyRequest;
use Ocart\Ecommerce\Repositories\Interfaces\CurrencyRepository;
use Ocart\Ecommerce\Table\BrandTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Table\CurrencyTable;

class CurrencyController extends BaseController
{
    /**
     * @var CurrencyRepository
     */
    protected $repo;

    public function __construct(CurrencyRepository $repo)
    {
        $this->repo = $repo;
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
            'index' => 'ecommerce.currencies.index',
            'show' => 'ecommerce.currencies.update',
            'create' => 'ecommerce.currencies.create',
            'store' => 'ecommerce.currencies.create',
            'edit' => 'ecommerce.currencies.update',
            'update' => 'ecommerce.currencies.update',
            'destroy' => 'ecommerce.currencies.destroy',
        ];
    }

    public function index(CurrencyTable $table)
    {
        page_title()->setTitle(trans('plugins/ecommerce::currency.currencies'));
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::currency.create'));

        return $formBuilder->create(CurrencyForm::class)
            ->setMethod('POST')
            ->setUrl(route('ecommerce.currencies.store'))
            ->renderForm();
    }

    function store(CurrencyRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $currency = $this->repo->create($data);
        $this->repo->updateIsDefault($request->get('is_default', 0), $currency->id);

        return $response->setPreviousUrl(route('ecommerce.currencies.index'))
            ->setNextUrl(route('ecommerce.currencies.show', $currency->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::currency.edit'));
        $currency = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(CurrencyForm::class, ['model' => $currency])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.currencies.update', ['id' => $currency->id]))
            ->renderForm();
    }

    function update($id, CurrencyRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $currency = $this->repo->update($data, $id);
        $this->repo->updateIsDefault($request->get('is_default', 0), $currency->id);

        return $response->setPreviousUrl(route('ecommerce.currencies.index'))
            ->setNextUrl(route('ecommerce.currencies.show', $currency->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
