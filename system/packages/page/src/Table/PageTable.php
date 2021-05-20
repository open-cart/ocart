<?php


namespace Ocart\Page\Table;

use Illuminate\Support\Facades\Date;
use Kris\LaravelFormBuilder\FormBuilder;
use Ocart\Page\Forms\PageFilterForm;
use Ocart\Page\Models\Page;
use Ocart\Page\Repositories\Criteria\PageSearchCriteria;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Collective\Html\HtmlBuilder;
use Ocart\Table\DataTables;

class PageTable extends TableAbstract
{

    public function __construct(DataTables $table, PageRepository $repo, HtmlBuilder $html, FormBuilder $formBuilder)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $repo->pushCriteria(app(PageSearchCriteria::class))->paginate();
        $this->ajax();

        $this->searchForm = $formBuilder->create(PageFilterForm::class, ['model' => request()->all()])
            ->renderForm();
    }

    public function ajax()
    {
        $data = $this->table->columns([
            'id' => [
                'name' => 'id',
                'title' => trans('packages/page::pages.forms.name'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
            'alias' => [
                'name' => 'alias',
                'title' => trans('admin.alias'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->slug;
                }
            ],
            'template' => [
                'name' => 'template',
                'title' => trans('admin.template'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->template;
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
                    return $this->tableActions('pages.update', 'pages.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('pages.create'), ['pages.create']);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Page::class);
    }
}
