<?php
namespace Ocart\Ecommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ocart\Core\Events\CreatedContentEvent;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Ecommerce\Forms\ProductForm;
use Ocart\Ecommerce\Http\Requests\ProductRequest;
use Ocart\Ecommerce\Http\Requests\ProductUpdateRequest;
use Ocart\Ecommerce\Repositories\Criteria\ProductSearchCriteria;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Ecommerce\Services\StoreCategoryService;
use Ocart\Ecommerce\Table\ProductTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Media\Facades\TnMedia;

class ProductController extends BaseController
{

    /**
     * @var ProductRepository
     */
    protected $repo;

    public function __construct(ProductRepository $repo)
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
            'index' => 'ecommerce.products.index',
            'show' => 'ecommerce.products.update',
            'create' => 'ecommerce.products.create',
            'store' => 'ecommerce.products.create',
            'edit' => 'ecommerce.products.update',
            'update' => 'ecommerce.products.update',
            'destroy' => 'ecommerce.products.destroy',
        ];
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
            ->setUrl(route('ecommerce.products.store'))
            ->renderForm();
    }

    function store(
        ProductRequest $request,
        BaseHttpResponse $response,
        StoreCategoryService $categoryService
    )
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $data['images'] = array_values(array_filter($request->input('images', [])));

        $data['images'] = json_encode(array_map(function ($image) {
            return TnMedia::url($image);
        }, Arr::wrap($data['images'])));

        DB::beginTransaction();

        $product = $this->repo->create($data + [
                'user_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

//        $this->repo->sync($product->id, 'tags', $request->input('tags'));
        $categoryService->executeTag($request, $product);

        event(new CreatedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

        $categoryService->execute($request, $product);

        DB::commit();

        return $response->setPreviousUrl(route('ecommerce.products.index'))
            ->setNextUrl(route('ecommerce.products.show', $product->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::products.edit'));
        $product = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(ProductForm::class, ['model' => $product])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.products.update', ['id' => $product->id]))
            ->renderForm();
    }

    function update(
        $id,
        ProductUpdateRequest $request,
        BaseHttpResponse $response,
        StoreCategoryService $categoryService
    )
    {
        $data = $request->all();

        DB::beginTransaction();

//        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
//        $data['slug_md5'] = md5($data['slug']);

        if ($request->input('images')) {
            $data['images'] = array_values(array_filter($request->input('images', [])));

            $data['images'] = array_map(function ($image) {
                return TnMedia::url($image);
            }, Arr::wrap($data['images']));

            $data['images'] = json_encode($data['images']);
        }

        $product = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

//        $this->repo->sync($product->id, 'tags', $request->input('tags'));
        $categoryService->executeTag($request, $product);

        event(new UpdatedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

        $categoryService->execute($request, $product);

        DB::commit();

        return $response->setPreviousUrl(route('ecommerce.products.index'))
            ->setNextUrl(route('ecommerce.products.show', $product->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }

    function getSearchProducts()
    {
        $this->repo->pushCriteria(ProductSearchCriteria::class);
        $products = $this->repo->paginate(5);

        return view('plugins.ecommerce::products.get-search-products', compact('products'));
    }
}
