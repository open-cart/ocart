<?php
namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\TaxForm;
use Ocart\Ecommerce\Http\Requests\TaxCreateRequest;
use Ocart\Ecommerce\Http\Requests\TaxUpdateRequest;
use Ocart\Ecommerce\Repositories\Interfaces\TaxRepository;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Ecommerce\Table\TaxTable;

class TaxController extends BaseController
{
    /**
     * @var TaxRepository
     */
    protected $repo;

    public function __construct(TaxRepository $repo)
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
            'index' => 'ecommerce.taxes.index',
            'show' => 'ecommerce.taxes.update',
            'create' => 'ecommerce.taxes.create',
            'store' => 'ecommerce.taxes.create',
            'edit' => 'ecommerce.taxes.update',
            'update' => 'ecommerce.taxes.update',
            'destroy' => 'ecommerce.taxes.destroy',
        ];
    }

    public function index(TaxTable $table)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tax.title'));
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tax.create'));

        return $formBuilder->create(TaxForm::class)
            ->setMethod('POST')
            ->setUrl(route('ecommerce.taxes.store'))
            ->renderForm();
    }

    function store(TaxCreateRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->create($data + [
                'author_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('ecommerce.taxes.index'))
            ->setNextUrl(route('ecommerce.taxes.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tax.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(TaxForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.taxes.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, TaxUpdateRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('ecommerce.taxes.index'))
            ->setNextUrl(route('ecommerce.taxes.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
