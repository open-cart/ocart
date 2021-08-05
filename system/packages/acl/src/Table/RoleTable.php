<?php


namespace Ocart\Acl\Table;

use App\Models\User;
use Ocart\Acl\Repositories\RoleRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Collective\Html\HtmlBuilder;
use Ocart\Table\DataTables;

class RoleTable extends TableAbstract
{

    public function __construct(DataTables $table, RoleRepository $repo, HtmlBuilder $html)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $repo->paginate(10);
        $this->ajax();
    }

    public function ajax()
    {
        $data = $this->table->columns([
            'id' => [
                'name' => 'name',
                'title' => trans('packages/acl::roles.name'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return '<a class="text-blue-500" href=" '.route('system.roles.update', $item->id).' ">' . $item->name . '</a>';
                }
            ],
            'guard_name' => [
                'name' => 'guard_name',
                'title' => trans('packages/acl::roles.guard_name'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->guard_name;
                }
            ],
            'description' => [
                'name' => 'guard_name',
                'title' => trans('packages/acl::roles.description'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->description;
                }
            ],

            'created_at' => [
                'name' => 'created_at',
                'title' => trans('admin.created_at'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->created_at;
                }
            ],
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions('system.roles.update', 'system.roles.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('system.roles.create'), ['system.roles.create']);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, User::class);
    }
}
