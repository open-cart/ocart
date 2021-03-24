<?php


namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\CategoryForm;
use Ocart\Ecommerce\Http\Requests\CategoryRequest;
use Ocart\Ecommerce\Models\Category;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Ecommerce\Table\CategoryTable;
use Prettus\Repository\Events\RepositoryEntityDeleting;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class CategoryController extends BaseController
{
    /**
     * @var CategoryRepository
     */
    protected $repo;

    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(CategoryTable $table)
    {
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::categories.create'));

        return $formBuilder->create(CategoryForm::class)
            ->setMethod('POST')
            ->setUrl(route('ecommerce.categories.store'))
            ->renderForm();
    }

    function store(CategoryRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->create($data + [
                'author_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('ecommerce.categories.index'))
            ->setNextUrl(route('ecommerce.categories.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::categories.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(CategoryForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.categories.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, CategoryRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('ecommerce.categories.index'))
            ->setNextUrl(route('ecommerce.categories.show', $page->id));
    }

    function destroy(Request $request)
    {
        Event::listen(RepositoryEntityDeleting::class, function($repo) {
            if ($repo->getModel() instanceof Category) {
                if ($repo->getModel()->is_default) {
                    throw new \Error(trans('core/base::notices.cannot_delete'));
                }
            }
        });

        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
