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
            'image' => [
                'name' => 'id',
                'title' => trans('plugins/blog::posts.image'),
                'width' => '120px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return '<img src="' . TnMedia::url($item->image ?? '/images/no-image.jpg') . '" alt="' . $item->title . '" class="w-14"/>';
                }
            ],
            'title' => [
                'name' => 'title',
                'title' => trans('plugins/blog::posts.name'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    $link = route('blog.posts.update', ['id' => $item->id]);
                    return "<a class='text-blue-400' href='$link'>$item->name</a>";
                }
            ],
            'categories' => [
                'name' => 'id',
                'title' => trans('plugins/blog::posts.categories'),
                'width' => '180px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return join(',', $item->categories->pluck('name')->toArray());
                }
            ],
            'created_at' => [
                'name' => 'created_at',
                'title' => trans('admin.created_at'),
                'width' => '180px',
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
