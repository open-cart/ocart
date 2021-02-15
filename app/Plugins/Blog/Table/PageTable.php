<?php


namespace App\Plugins\Blog\Table;

use System\Core\Tables\TableAbstract;
use Collective\Html\HtmlBuilder;
use Yajra\DataTables\Html\Builder;
use App\Plugins\Blog\Repositories\PageRepository;

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
                    return $this->tableActions('plugin_blog::admin.edit', 'plugin_blog::admin.delete', $item);
                }
            ]
        ];
    }

    public function buttons()
    {
        $this->addCreateButton(route('plugin_blog::admin.create'), []);
        return parent::buttons();
    }
}
