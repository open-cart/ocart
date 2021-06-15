<?php


namespace Ocart\Ecommerce\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Ecommerce\Forms\TagForm;
use Ocart\Ecommerce\Http\Requests\TagRequest;
use Ocart\Ecommerce\Repositories\Interfaces\TagRepository;
use Ocart\Ecommerce\Table\TagTable;
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
            'index' => 'ecommerce.tags.index',
            'show' => 'ecommerce.tags.update',
            'create' => 'ecommerce.tags.create',
            'store' => 'ecommerce.tags.create',
            'edit' => 'ecommerce.tags.update',
            'update' => 'ecommerce.tags.update',
            'destroy' => 'ecommerce.tags.destroy',
        ];
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
            ->setUrl(route('ecommerce.tags.store'))
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

        return $response->setPreviousUrl(route('ecommerce.tags.index'))
            ->setNextUrl(route('ecommerce.tags.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::tags.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(TagForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.tags.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, TagRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('ecommerce.tags.index'))
            ->setNextUrl(route('ecommerce.tags.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }

    public function ajaxSearchTags(Request $request)
    {
        $tags = $this->repo->scopeQuery(function ($query) use ($request) {
            $txt = $request->input('name', '');
            return $query->where('name', 'like', "%$txt%");
        })->limit(50);

        return view('plugins.ecommerce::tags.ajax_search_tags', compact('tags',));
    }
}
