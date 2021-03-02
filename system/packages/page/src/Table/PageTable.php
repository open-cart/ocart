<?php


namespace Ocart\Page\Table;

use Illuminate\Support\Facades\Date;
use Ocart\Page\Models\Page;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Collective\Html\HtmlBuilder;
use Ocart\Table\DataTables;
use Yajra\DataTables\Html\Builder;

class PageTable extends TableAbstract
{

    public function __construct(DataTables $table, PageRepository $repo, HtmlBuilder $html)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $repo->paginate();
        $this->ajax();
    }

    public function ajax()
    {
        $data = $this->table->columns([
            'id' => [
                'name' => 'id',
                'title' => 'title',
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
            'image' => [
                'name' => 'id',
                'title' => 'image',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return '<img src="' . ($item->image ?? '/images/no-image.jpg') . '" alt="' . $item->title . '" class="w-14"/>';
                }
            ],
            'alias' => [
                'name' => 'alias',
                'title' => 'URL Tùy chỉnh',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->slug;
                }
            ],
            'craeteAt' => [
                'name' => 'created_at',
                'title' => 'Ngày tạo',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->created_at;
                }
            ],
            'status' => [
                'name' => 'status',
                'title' => __('admin.status'),
                'class' => 'border text-left px-2 py-2',
                'width' => '120px',
                'render' => function ($item) {
                    return $item->status->toHtml();
                    return view('components.activated', ['active' => $item->status]);
                }
            ]
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions('pages.update', 'pages.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('pages.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Page::class);
    }
}
