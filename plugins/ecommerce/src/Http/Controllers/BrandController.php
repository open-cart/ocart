<?php
namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\BrandForm;
use Ocart\Ecommerce\Http\Requests\BrandRequest;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Ecommerce\Table\BrandTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class BrandController extends BaseController
{
    /**
     * @var BrandRepository
     */
    protected $repo;

    public function __construct(BrandRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(BrandTable $table)
    {
        page_title()->setTitle(trans('plugins/ecommerce::brands.title'));
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::brands.create'));

        return $formBuilder->create(BrandForm::class)
            ->setMethod('POST')
            ->setUrl(route('ecommerce.brands.store'))
            ->renderForm();
    }

    function store(BrandRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->create($data + [
                'author_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('ecommerce.brands.index'))
            ->setNextUrl(route('ecommerce.brands.show', $page->id));
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
