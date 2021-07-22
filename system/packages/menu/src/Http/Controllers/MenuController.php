<?php
namespace Ocart\Menu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Menu\Forms\MenuForm;
use Ocart\Menu\Forms\MenuUpdateForm;
use Ocart\Menu\Http\Requests\MenuRequest;
use Ocart\Menu\Models\Menu;
use Ocart\Menu\Models\MenuNode;
use Ocart\Menu\Repositories\MenuNodeRepository;
use Ocart\Menu\Repositories\MenuRepository;
use Ocart\Menu\Tables\MenuTable;

class MenuController extends BaseController
{
    /**
     * @var MenuRepository
     */
    protected $menuRepository;

    /**
     * @var MenuNodeRepository
     */
    protected $menuNodeRepository;

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
//            'index' => 'menus.index',
            'show' => 'menus.update',
            'create' => 'menus.create',
            'store' => 'menus.create',
            'edit' => 'menus.update',
            'update' => 'menus.update',
            'destroy' => 'menus.destroy',
        ];
    }

    public function __construct(MenuRepository $menuRepository, MenuNodeRepository $menuNodeRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->menuNodeRepository = $menuNodeRepository;
        $this->authorizeResource(Menu::class, 'id');
    }

    public function index(MenuTable $table)
    {
        page_title()->setTitle(trans('packages/menu::menus.menu'));
        return $table->render();
    }

    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/menu::menus.create'));
        return $formBuilder->create(MenuForm::class)
            ->setMethod('POST')
            ->setUrl(route('menus.store'))
            ->renderForm();
    }

    function store(MenuRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        $menu = $this->menuRepository->create($data);

        return $response->setPreviousUrl(route('menus.index'))
            ->setNextUrl(route('menus.show', $menu->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/menu::menus.edit'));
        $menu = $this->menuRepository->skipCriteria()->find($id);

        return $formBuilder->create(MenuForm::class, ['model' => $menu])
            ->setMethod('PUT')
            ->setUrl(route('menus.update', ['id' => $menu->id]))
            ->renderForm();
    }

    function update($id, MenuRequest $request, BaseHttpResponse $response)
    {
        $data = $request->all();

        \DB::beginTransaction();

        $menu = $this->menuRepository->update($data, $id);

        $settings = $request->input('navigation', []);

        foreach ($settings as $key) {
            setting()->set($key, $menu->id)->save();
        }

        $deletedNodes = ltrim($request->input('deleted_nodes', ''));
        if ($deletedNodes) {
            $deletedNodes = explode(',', ltrim($request->input('deleted_nodes', '')));
            foreach($deletedNodes as $key => $val){
                if (empty($val)) unset($deletedNodes[$key]);
            }
            $this->menuNodeRepository->scopeQuery(function ($q) use ($deletedNodes) {
                return $q->whereIn('id', $deletedNodes);
            })->deleteWhere([]);
        }

        $this->recursiveSaveMenu(json_decode($request->input('menu_nodes'), true), $menu->id, 0);

        \DB::commit();

        return $response->setPreviousUrl(route('menus.index'))
            ->setNextUrl(route('menus.show', $menu->id));
    }

    public function recursiveSaveMenu($menuNodes, $menuId, $parentId) {
        $i = 0;
        foreach ($menuNodes as $row) {
            $child = Arr::get($row, 'children', []);

            $row['parent_id'] = $parentId;
            $row['menu_id'] = $menuId;
            $row['position'] = $i;
            if ($row['reference_type'] == 'custom-link') {
                $row['reference_type'] = null;
            }

            $parent = null;

            $menuNodeRepository = app(MenuNodeRepository::class);
            if ($id = Arr::get($row, 'id')) {
                $parent = $menuNodeRepository->update($row, $id);
            } else {
                $parent = $menuNodeRepository->create($row);
            }

            if (!empty($parent)) {
                $this->recursiveSaveMenu($child, $menuId, $parent->id);
            }
            $i++;
        }
    }

    function destroy(Request $request)
    {
        $this->menuRepository->delete($request->input('id'));

        return response()->json([]);
    }
}
