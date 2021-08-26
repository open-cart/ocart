<?php
namespace Ocart\Acl\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ocart\Acl\Forms\RoleForm;
use Ocart\Acl\Http\Requests\RoleRequest;
use Ocart\Acl\Models\Role;
use Ocart\Acl\Repositories\RoleRepository;
use Ocart\Acl\Table\RoleTable;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class RoleController extends BaseController
{
    /**
     * @var RoleRepository
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
            'index' => 'system.roles.index',
            'show' => 'system.roles.update',
            'create' => 'system.roles.create',
            'store' => 'system.roles.create',
            'edit' => 'system.roles.update',
            'update' => 'system.roles.update',
            'destroy' => 'system.roles.destroy',
        ];
    }

    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
        $this->authorizeResource(Role::class, 'id');
    }

    public function index(RoleTable $table)
    {
        page_title()->setTitle(trans('packages/page::pages.menu'));
        return $table->render();
    }

    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/page::pages.create'));
        return $formBuilder->create(RoleForm::class)
            ->setMethod('POST')
            ->setUrl(route('system.roles.store'))
            ->renderForm();
    }

    function store(RoleRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $data['guard_name'] = 'admin';

        $data['permissions'] = $this->cleanPermission($request->input('permissions', []));

        $role = $this->repo->create($data);

        return $response->setPreviousUrl(route('system.roles.index'))
            ->setNextUrl(route('system.roles.show', $role->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/page::pages.edit'));
        $page = $this->repo->skipCriteria()->find($id);

        return $formBuilder->create(RoleForm::class, ['model' => $page])
            ->setMethod('PUT')
            ->setUrl(route('system.roles.update', ['id' => $page->id]))
            ->renderForm();
    }

    function update($id, RoleRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $data['permissions'] = $this->cleanPermission($request->input('permissions', []));

        /** @var Role $user */
        $role = $this->repo->update($data, $id);


//        $role->syncPermissions($request->permissions);

//        $role->forgetCachedPermissions();

        return $response->setPreviousUrl(route('system.roles.index'))
            ->setNextUrl(route('system.roles.show', $role->id));
    }

    function destroy(Request $request)
    {
        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }

    /**
     * Return a correctly type casted permissions array
     * @param array $permissions
     * @return array
     */
    protected function cleanPermission($permissions)
    {
        if (!$permissions) {
            return [];
        }

        $cleanedPermissions = [];
        foreach ($permissions as $permissionName) {
            $cleanedPermissions[$permissionName] = true;
        }

        return $cleanedPermissions;
    }
}
