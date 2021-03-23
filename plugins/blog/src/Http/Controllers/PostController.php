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
    }

    public function index(PostTable $blog)
    {
        return $blog->render();
    }

    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::posts.create'));

        return $formBuilder->create(PostForm::class)
            ->setMethod('POST')
            ->setUrl(route('posts.store'))
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

        return $response->setPreviousUrl(route('posts.index'))
            ->setNextUrl(route('posts.show', $post->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::posts.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(PostForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('posts.update', ['id' => $page->id]))
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

        return $response->setPreviousUrl(route('posts.index'))
            ->setNextUrl(route('posts.show', $post->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
