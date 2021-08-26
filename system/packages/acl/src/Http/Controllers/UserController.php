<?php
namespace Ocart\Acl\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'index' => 'system.users.index',
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
        $this->authorizeResource($repo->model(), 'id');
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

        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        DB::beginTransaction();

        $user = $this->repo->create($data);

        $user->syncRoles($request->roles);

        DB::commit();

        return $response->setPreviousUrl(route('system.users.index'))
            ->setNextUrl(route('system.users.show', $user->id));
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

        unset($data['password']);

        if ($password = $request->input('password', null)) {
            $data['password'] = Hash::make($request['password']);
        }

        DB::beginTransaction();

        /** @var User $user */
        $user = $this->repo->update($data, $id);

        $user->syncRoles($request->roles);

        DB::commit();

        return $response->setPreviousUrl(route('system.users.index'))
            ->setNextUrl(route('system.users.show', $user->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}
