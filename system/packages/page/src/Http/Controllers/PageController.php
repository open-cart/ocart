<?php
namespace Ocart\Page\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Ocart\Page\Forms\PageForm;
use Ocart\Page\Http\Requests\PageRequest;
use Ocart\Page\Models\Page;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Page\Table\PageTable;
use Prettus\Validator\Exceptions\ValidatorException;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class PageController extends BaseController
{
    /**
     * @var \Ocart\Page\Repositories\PageRepository
     */
    protected $repo;

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'pages.index',
            'show' => 'pages.update',
            'create' => 'pages.create',
            'store' => 'pages.create',
            'edit' => 'pages.update',
            'update' => 'pages.update',
            'destroy' => 'pages.destroy',
        ];
    }

    public function __construct(PageRepository $repo)
    {
        $this->repo = $repo;
        $this->authorizeResource(Page::class, 'id');
    }

    public function index(PageTable $table)
    {
        page_title()->setTitle(trans('packages/page::pages.menu'));
        return $table->render();
    }

    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/page::pages.create'));
        return $formBuilder->create(PageForm::class)
            ->setMethod('POST')
            ->setUrl(route('pages.store'))
            ->renderForm();
    }

    function store(PageRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->create($data + [
                'user_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('pages.index'))
            ->setNextUrl(route('pages.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
//        dd(Gate::forUser(Auth::user())->check('pages-update', 1));
//        $this->authorize('pages.update', $id);
        page_title()->setTitle(trans('packages/page::pages.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(PageForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('pages.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, PageRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
//        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
//        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->update($data + [
                'is_featured' => $request->input('is_featured', false),
            ], $id);

        return $response->setPreviousUrl(route('pages.index'))
            ->setNextUrl(route('pages.show', $page->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
