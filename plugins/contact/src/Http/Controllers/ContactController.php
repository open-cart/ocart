<?php


namespace Ocart\Contact\Http\Controllers;


use Illuminate\Http\Request;
use Ocart\Contact\Forms\ContactForm;
use Ocart\Contact\Http\Requests\UpdateContactRequest;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;
use Ocart\Contact\Tables\ContactTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class ContactController extends BaseController
{
    /**
     * @var ContactRepository
     */
    protected $repo;

    public function __construct(ContactRepository $repo)
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

    public function index(ContactTable $table)
    {
        return $table->render();
    }


    function create(BaseHttpResponse $response)
    {
        return $response->setMessage('successfully');
    }

    function store(BaseHttpResponse $response)
    {
//        $data = $request->all();
//        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
//        $data['slug_md5'] = md5($data['slug']);
//
//        $page = $this->repo->create($data + [
//                'author_id'     => Auth::user()->getKey(),
//                'is_featured' => $request->input('is_featured', false),
//            ]);
//
//        return $response->setPreviousUrl(route('blog.tags.index'))
//            ->setNextUrl(route('blog.tags.show', $page->id));
        return $response->setMessage('successfully');
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/contact::contact.edit'));

        $contact = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(ContactForm::class, ['model' => $contact])
            ->setMethod('PUT')
            ->setUrl(route('contacts.update', ['id' => $contact->id]))
            ->renderForm([], true, false);
    }

    function update($id, UpdateContactRequest $request, BaseHttpResponse $response)
    {
        $contact = $this->repo->update($request->all(['status']), $id);

        return $response->setPreviousUrl(route('contacts.index'))
            ->setNextUrl(route('contacts.show', $contact->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
