<?php


namespace Ocart\Blog\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Blog\Forms\TagForm;
use Ocart\Blog\Http\Requests\TagRequest;
use Ocart\Blog\Repositories\Interfaces\TagRepository;
use Ocart\Blog\Tables\TagTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class TagController extends BaseController
{
    /**
     * @var TagRepository
     */
    protected $repo;

    public function __construct(TagRepository $repo)
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
            'index' => 'blog.tags.index',
            'show' => 'blog.tags.update',
            'create' => 'blog.tags.create',
            'store' => 'blog.tags.create',
            'edit' => 'blog.tags.update',
            'update' => 'blog.tags.update',
            'destroy' => 'blog.tags.destroy',
        ];
    }

    public function index(TagTable $table)
    {
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/blog::tags.create'));

        return $formBuilder->create(TagForm::class)
            ->setMethod('POST')
            ->setUrl(route('blog.tags.store'))
            ->renderForm();
    }

    function store(TagRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->create($data + [
                'author_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('blog.tags.index'))
            ->setNextUrl(route('blog.tags.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/blog::tags.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(TagForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('blog.tags.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, TagRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('blog.tags.index'))
            ->setNextUrl(route('blog.tags.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
