<?php
namespace Ocart\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Page\Forms\PageForm;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Page\Services\StorePageDescriptionService;
use Ocart\Page\Table\PageTable;
use Prettus\Validator\Exceptions\ValidatorException;
use System\Core\Forms\FormBuilder;
use System\Core\Http\Responses\BaseHttpResponse;

class PageController extends BaseController
{
    /**
     * @var \Ocart\Page\Repositories\PageRepository
     */
    protected $repo;

    public function __construct(PageRepository $repo)
    {
        $this->repo = $repo;
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

    function store(Request $request, BaseHttpResponse $response)
    {
        try {
            $data = $request->all();
            $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
            $data['slug_md5'] = md5($data['slug']);

            $page = $this->repo->create($data + [
                'user_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

            return $response->setPreviousUrl(route('pages.index'))
                ->setNextUrl(route('pages.show', $page->id));
        } catch (ValidatorException $e) {
            return back()
                ->withInput($data)
                ->withErrors($e->getMessageBag());
        } catch (\Exception $e) {
            throw $e;
        }
//
        return redirect()->route('pages.index');
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/page::pages.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(PageForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('pages.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, Request $request)
    {
        try {
            $data = $request->all();
            $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
            $data['slug_md5'] = md5($data['slug']);

            $this->repo->update($data + [
                    'is_featured' => $request->input('is_featured', false),
                ], $id);

        } catch (ValidatorException $e) {
            return back()
                ->withInput($data)
                ->withErrors($e->getMessageBag());
        } catch (\Exception $e) {
            throw $e;
        }

        return redirect()->route('pages.index');
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
