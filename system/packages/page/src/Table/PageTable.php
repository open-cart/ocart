<?php


namespace Ocart\Page\Table;

use Ocart\Page\Models\Page;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Collective\Html\HtmlBuilder;
use Yajra\DataTables\Html\Builder;

class PageTable extends TableAbstract
{

    public function __construct(PageRepository $repo, Builder $table, HtmlBuilder $html)
    {
        parent::__construct($html);
        $this->_table = $table;
        $this->data = $repo->paginate();
    }

    public function columns()
    {
        return [
            'id' => [
                'name' => 'id',
                'title' => 'title',
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function($item) {
                    return $item->title;
                }
            ],
            'image' => [
                'name' => 'id',
                'title' => 'image',
                'class' => 'border text-left px-2 py-2',
                'render' => function($item) {
                    return '<img src="' . ($item->image ?? '/images/no-image.jpg') . '" alt="' . $item->title.'" class="w-14"/>';
                }
            ],
            'alias' => [
                'name' => 'alias',
                'title' => 'URL Tùy chỉnh',
                'class' => 'border text-left px-2 py-2',
                'render' => function($item) {
                    return $item->alias;
                }
            ],
            'status' => [
                'name' => 'status',
                'title' =>  __('admin.status'),
                'class' => 'border text-left px-2 py-2',
                'render' => function($item) {
                    return view('components.activated', ['active' => $item->status]);
                }
            ],
            'actions' => [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions('pages.update', 'pages.destroy', $item);
                }
            ]
        ];
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('pages.create'), []);

        return apply_filters('base_table_action', $buttons, Page::class);
    }
}
