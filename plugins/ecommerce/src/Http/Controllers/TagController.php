<?php


namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\TagForm;
use Ocart\Ecommerce\Http\Requests\TagRequest;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Table\TagTable;
use System\Core\Forms\FormBuilder;
use System\Core\Http\Responses\BaseHttpResponse;

class TagController
{
    /**
     * @var TagRepository
     */
    protected $repo;

    public function __construct(TagRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(TagTable $table)
    {
        return $table->render();
    }


    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tags.create'));

        return $formBuilder->create(TagForm::class)
            ->setMethod('POST')
            ->setUrl(route('tags.store'))
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

        return $response->setPreviousUrl(route('tags.index'))
            ->setNextUrl(route('tags.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tags.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(TagForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('tags.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, TagRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('tags.index'))
            ->setNextUrl(route('tags.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
