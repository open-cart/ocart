<?php
namespace Ocart\Ecommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\ProductForm;
use Ocart\Ecommerce\Http\Requests\ProductRequest;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Table\ProductTable;
use System\Core\Forms\FormBuilder;
use System\Core\Http\Controllers\BaseController;
use System\Core\Http\Responses\BaseHttpResponse;

class ProductController extends BaseController
{

    /**
     * @var ProductRepository
     */
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(ProductTable $table)
    {
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::products.create'));

        return $formBuilder->create(ProductForm::class)
            ->setMethod('POST')
            ->setUrl(route('products.store'))
            ->renderForm();
    }

    function store(ProductRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->create($data + [
                'user_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('products.index'))
            ->setNextUrl(route('products.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::products.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(ProductForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('products.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, ProductRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('products.index'))
            ->setNextUrl(route('products.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
