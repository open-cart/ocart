<?php
namespace Ocart\Page\Http\Controllers;

use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Ocart\Page\Models\Page;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Page\Services\StorePageDescriptionService;
use Ocart\Page\Table\PageTable;
use Prettus\Validator\Exceptions\ValidatorException;

class PageController extends BaseController
{
    /**
     * @var \Ocart\Page\Repositories\PageRepository
     */
    protected $repo;

    protected $languages;

    public function __construct(PageRepository $repo, LanguageRepository $languageRepository)
    {
        $this->repo = $repo;
        $this->languages = $languageRepository->getListActive();
        view()->share('languages', $this->languages);
    }

    public function index(PageTable $table)
    {
        return $table->render();

//        return view('packages/page::index');
    }

    function create()
    {
        return  view('packages/page::page')
            ->with('page', [])
            ->with('model', $this->repo->getModel())
            ->with('url_action', route('pages.store'));
    }

    function store(Request $request, StorePageDescriptionService $pageDescriptionService)
    {
        try {
            $data = $request->all();
            $lang = $this->languages->first()->code;
            $data['alias'] = $request->input('alias') ?? Str::limit(Str::slug($request->input('description.'.$lang.'.title')));

            $page = $this->repo->create($data);
            $pageDescriptionService->execute($request, $page);
        } catch (ValidatorException $e) {
            return back()
                ->withInput($data)
                ->withErrors($e->getMessageBag());
        }

        return redirect()->route('pages.index');
    }

    function show($id)
    {
        $page = $this->repo->skipCriteria()->find($id);

        $data = $page->toArray()+[
            'description' => $page->description->keyBy('lang')->toArray()
        ];


        return  view('packages/page::page')
            ->with('url_action', route('pages.update', ['id' => $page->id]))
            ->with('model', $page)
            ->with('page', $data);
    }

    function update($id, Request $request, StorePageDescriptionService $pageDescriptionService)
    {
        try {
            $data = $request->all();
            $lang = $this->languages->first()->code;
            $data['alias'] = $request->input('alias') ?? Str::limit(Str::slug($request->input('description.'.$lang.'.title')));

            $page = $this->repo->update($data, $id);
            $pageDescriptionService->execute($request, $page);
        } catch (ValidatorException $e) {
            return back()
                ->withInput($data)
                ->withErrors($e->getMessageBag());
        }

        return redirect()->route('pages.index');
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
