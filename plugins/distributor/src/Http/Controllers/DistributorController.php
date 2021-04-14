<?php


namespace Ocart\Distributor\Http\Controllers;


use Illuminate\Http\Request;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Distributor\Forms\DistributorForm;
use Ocart\Distributor\Http\Requests\DistributorRequest;
use Ocart\Distributor\Repositories\Interfaces\DistributorRepository;
use Ocart\Distributor\Tables\DistributorTable;

class DistributorController extends BaseController
{
    /**
     * @var DistributorRepository
     */
    protected $repo;

    public function __construct(DistributorRepository $repo)
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
            'index' => 'distributors.index',
            'show' => 'distributors.update',
            'create' => 'distributors.create',
            'store' => 'distributors.create',
            'edit' => 'distributors.update',
            'update' => 'distributors.update',
            'destroy' => 'distributors.destroy',
        ];
    }

    public function index(DistributorTable $table)
    {
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/distributor::distributor.create'));

        return $formBuilder->create(DistributorForm::class)
            ->setMethod('POST')
            ->setUrl(route('distributors.store'))
            ->renderForm();
    }

    function store(DistributorRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->create($data);

        return $response->setPreviousUrl(route('distributors.index'))
            ->setNextUrl(route('distributors.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/distributor::distributor.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(DistributorForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('distributors.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, DistributorRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data, $id);

        return $response->setPreviousUrl(route('distributors.index'))
            ->setNextUrl(route('distributors.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
