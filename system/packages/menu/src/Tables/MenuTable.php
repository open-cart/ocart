<?php


namespace Ocart\Menu\Tables;

use Kris\LaravelFormBuilder\FormBuilder;
use Ocart\Menu\Repositories\MenuRepository;
use Ocart\Page\Models\Page;
use Ocart\Table\Abstracts\TableAbstract;
use Collective\Html\HtmlBuilder;
use Ocart\Table\DataTables;

class MenuTable extends TableAbstract
{

    public function __construct(DataTables $table,MenuRepository $repo, HtmlBuilder $html, FormBuilder $formBuilder)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $repo->paginate();
        $this->ajax();

//        $this->searchForm = $formBuilder->create(PageFilterForm::class, ['model' => request()->all()])
//            ->renderForm();
    }

    public function ajax()
    {
        $data = $this->table->columns([
            'id' => [
                'name' => 'id',
                'title' => 'ID',
                'width' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->id;
                }
            ],
            'name' => [
                'name' => 'name',
                'title' => trans('packages/page::pages.forms.name'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return '<a class="text-blue-500" href="'.route('menus.update', ['id' => $item->id]).'">'.$item->name.'</a>';
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
            'status' => [
                'name' => 'status',
                'title' => __('admin.status'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'width' => '120px',
                'render' => function ($item) {
                    return $item->status->toHtml();
                }
            ]
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions('menus.update', 'menus.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('menus.create'), ['menus.create']);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Page::class);
    }
}
