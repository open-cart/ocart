<?php


namespace Ocart\Blog\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Ocart\Blog\Forms\CategoryForm;
use Ocart\Blog\Http\Requests\CategoryRequest;
use Ocart\Blog\Models\Category;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Blog\Tables\CategoryTable;
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
            'index' => 'blog.categories.index',
            'show' => 'blog.categories.update',
            'create' => 'blog.categories.create',
            'store' => 'blog.categories.create',
            'edit' => 'blog.categories.update',
            'update' => 'blog.categories.update',
            'destroy' => 'blog.categories.destroy',
        ];
    }

    public function index(CategoryTable $table)
    {
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/blog::categories.create'));

        return $formBuilder->create(CategoryForm::class)
            ->setMethod('POST')
            ->setUrl(route('blog.categories.store'))
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

        return $response->setPreviousUrl(route('blog.categories.index'))
            ->setNextUrl(route('blog.categories.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/blog::categories.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(CategoryForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('blog.categories.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, CategoryRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('blog.categories.index'))
            ->setNextUrl(route('blog.categories.show', $page->id));
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
