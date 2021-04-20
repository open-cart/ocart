<?php
namespace Ocart\Blog\Tables;

use Collective\Html\HtmlBuilder;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Media\Facades\TnMedia;
use Ocart\Page\Models\Page;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class PostTable extends TableAbstract
{
    public function __construct(DataTables $table, PostRepository $repo, HtmlBuilder $html)
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
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
            'image' => [
                'name' => 'id',
                'title' => 'image',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return '<img src="' . TnMedia::url($item->image ?? '/images/no-image.jpg') . '" alt="' . $item->title . '" class="w-14"/>';
                }
            ],
            'alias' => [
                'name' => 'alias',
                'title' => 'URL Tùy chỉnh',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->slug;
                }
            ],
            'categories' => [
                'name' => 'id',
                'title' => 'Category',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return join(',', $item->categories->pluck('name')->toArray());
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
                    return $this->tableActions('blog.posts.update', 'blog.posts.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('blog.posts.create'), []);

        return apply_filters('base_table_action', $buttons, Page::class);
    }
}
