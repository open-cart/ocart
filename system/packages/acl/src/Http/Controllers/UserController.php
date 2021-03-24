<?php
namespace Ocart\Acl\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ocart\Acl\Forms\UserForm;
use Ocart\Acl\Http\Requests\UserRequest;
use Ocart\Acl\Repositories\UserRepository;
use Ocart\Acl\Table\UserTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class UserController extends BaseController
{
    /**
     * @var UserRepository
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
//            'index' => 'pages.index',
            'show' => 'system.users.update',
            'create' => 'system.users.create',
            'store' => 'system.users.create',
            'edit' => 'system.users.update',
            'update' => 'system.users.update',
            'destroy' => 'system.users.destroy',
        ];
    }

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->authorizeResource(User::class, 'id');
    }

    public function index(UserTable $table)
    {
        page_title()->setTitle(trans('packages/page::pages.menu'));
        return $table->render();
    }

    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/page::pages.create'));
        return $formBuilder->create(UserForm::class)
            ->setMethod('POST')
            ->setUrl(route('system.users.store'))
            ->renderForm();
    }

    function store(UserRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
        $data['slug_md5'] = md5($data['slug']);

        $page = $this->repo->create($data + [
                'user_id'     => Auth::user()->getKey(),
                'is_featured' => $request->input('is_featured', false),
            ]);

        return $response->setPreviousUrl(route('system.users.index'))
            ->setNextUrl(route('system.users.show', $page->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
//        dd(Gate::forUser(Auth::user())->check('pages-update', 1));
//        $this->authorize('system.users.update', $id);
        page_title()->setTitle(trans('packages/page::pages.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(UserForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('system.users.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, UserRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();
//        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('name')));
//        $data['slug_md5'] = md5($data['slug']);

        unset($data['password']);

        if ($password = $request->input('password', null)) {
            $data['password'] = Hash::make($request['password']);
        }

        /** @var User $user */
        $user = $this->repo->update($data, $id);

        $user->syncRoles($request->roles);
        $user->forgetCachedPermissions();

        return $response->setPreviousUrl(route('system.users.index'))
            ->setNextUrl(route('system.users.show', $user->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
