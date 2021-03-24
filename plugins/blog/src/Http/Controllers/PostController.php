<?php

namespace Ocart\Blog\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Blog\Tables\PostTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Blog\Forms\PostForm;
use Ocart\Blog\Http\Requests\PostRequest;
use Ocart\Blog\Services\StoreCategoryService;

class PostController extends BaseController
{
    /**
     * @var PostRepository
     */
    protected $repo;

    public function __construct(PostRepository $repo)
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
            'index' => 'blog.posts.index',
            'show' => 'blog.posts.update',
            'create' => 'blog.posts.create',
            'store' => 'blog.posts.create',
            'edit' => 'blog.posts.update',
            'update' => 'blog.posts.update',
            'destroy' => 'blog.posts.destroy',
        ];
    }

    public function index(PostTable $blog)
    {
        return $blog->render();
    }

    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/blog::posts.create'));

        return $formBuilder->create(PostForm::class)
            ->setMethod('POST')
            ->setUrl(route('blog.posts.store'))
            ->renderForm();
    }

    function store(
        PostRequest $request,
        BaseHttpResponse $response,
        StoreCategoryService $categoryService
    )
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $post = $this->repo->create($data + [
                'author_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        $categoryService->execute($request, $post);

        return $response->setPreviousUrl(route('blog.posts.index'))
            ->setNextUrl(route('blog.posts.show', $post->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/blog::posts.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(PostForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('blog.posts.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update(
        $id,
        PostRequest $request,
        BaseHttpResponse $response,
        StoreCategoryService $categoryService
    )
    {
        $data = $request->all();

        $post = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        $categoryService->execute($request, $post);

        return $response->setPreviousUrl(route('blog.posts.index'))
            ->setNextUrl(route('blog.posts.show', $post->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
