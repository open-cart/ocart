<?php


namespace App\Plugins\Blog\Admin;


use App\Models\User;
use App\Plugins\Blog\Models\Page;
use App\Plugins\Blog\Repositories\PageRepository;
use App\Plugins\Blog\Services\StorePageDescriptionService;
use App\Plugins\Blog\Table\PageTable;
use App\Repositories\LanguageRepository;
use Core\Library\MapData;
use \Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;
use Validator;
use DataTables;

class PageController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $repo;

    protected $languages;

    public function __construct(PageRepository $repo, LanguageRepository $languageRepository)
    {
        $this->repo = $repo;
        $this->languages = $languageRepository->getListActive();
        view()->share('languages', $this->languages);
    }

    function index(PageTable $table)
    {

        add_action('nguyen', function($name) {
           return $name;
        },1);
        add_action('nguyen', function($name) {
            return '$name';
        },1);

        add_filter('base_table_action', function ($buttons, $model) {
            $buttons['reload'] = '<input/>';

            return $buttons;
        }, 0, 2);


        return $table->render();
        $pages = $this->repo->paginate();
        $pages->getCollection()->map(function ($page) {
            $page->editAction = route('plugin_blog::admin.edit', ['id' => $page->id]);
            return $page;
        });

//
        return view('blog::blog')->with('pages', $pages);
    }

    function create()
    {
        return  view('blog::create')
            ->with('page', [])
            ->with('url_action', route('plugin_blog::admin.create'));
    }

    function createPost(Request $request, StorePageDescriptionService $pageDescriptionService)
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

        return redirect()->route('plugin_blog::admin.index');
    }

    function edit($id)
    {
        $page = $this->repo->skipCriteria()->find($id);

        $data = $page->toArray()+[
            'description' => $page->description->keyBy('lang')->toArray()
        ];


        return  view('blog::create')
            ->with('url_action', route('plugin_blog::admin.edit', ['id' => $page->id]))
            ->with('page', $data);
    }

    function editPost($id, Request $request, StorePageDescriptionService $pageDescriptionService)
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

        return redirect()->route('plugin_blog::admin.index');
    }

    function delete(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
