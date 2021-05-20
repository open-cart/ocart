<?php


namespace Ocart\Acl\Table;

use App\Models\User;
use Kris\LaravelFormBuilder\FormBuilder;
use Ocart\Acl\Forms\UserFilterForm;
use Ocart\Acl\Repositories\Criteria\UserSearchCriteria;
use Ocart\Acl\Repositories\UserRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Collective\Html\HtmlBuilder;
use Ocart\Table\DataTables;

class UserTable extends TableAbstract
{

    public function __construct(DataTables $table, UserRepository $repo, HtmlBuilder $html, FormBuilder $formBuilder)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $repo->with('roles')
            ->pushCriteria(app(UserSearchCriteria::class))
            ->paginate(10);
        $this->ajax();

        $this->searchForm = $formBuilder->create(UserFilterForm::class, ['model' => request()->all()])
            ->renderForm();
    }

    public function ajax()
    {
        $data = $this->table->columns([
            'id' => [
                'name' => 'id',
                'title' => trans('packages/acl::users.full_name'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
//            'name' => [
//                'name' => 'name',
//                'title' => 'full name',
//                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
//                'render' => function ($item) {
//                    return $item->name;
//                }
//            ],
//            'image' => [
//                'name' => 'id',
//                'title' => 'image',
//                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
//                'render' => function ($item) {
//                    return '<img src="' . ($item->image ?? '/images/no-image.jpg') . '" alt="' . $item->title . '" class="w-14"/>';
//                }
//            ],
            'email' => [
                'name' => 'email',
                'title' => trans('packages/acl::users.email'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->email;
                }
            ],
            'role' => [
                'name' => 'roles',
                'title' => trans('packages/acl::users.roles'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return join(',', $item->roles->pluck('name')->toArray()) ?: trans('packages/acl::users.unknown');
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
                    return $this->tableActions('system.users.update', 'system.users.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('system.users.create'), ['system.users.create']);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, User::class);
    }
}
