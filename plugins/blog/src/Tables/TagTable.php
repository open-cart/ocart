<?php
namespace Ocart\Blog\Tables;

use Collective\Html\HtmlBuilder;
use Ocart\Blog\Models\Tag;
use Ocart\Blog\Repositories\Interfaces\TagRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class TagTable extends TableAbstract
{
    public function __construct(DataTables $table, TagRepository $repo, HtmlBuilder $html)
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
                'title' => 'ID',
                'width' => '20px',
                'class' => 'border text-center px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->id;
                }
            ],
            'name' => [
                'name' => 'name',
                'title' => trans('plugins/blog::tags.name'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    $link = route('blog.tags.update', ['id' => $item->id]);
                    return "<a class='text-blue-400' href='$link'>$item->name</a>";
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
                    return $this->tableActions('blog.tags.update', 'blog.tags.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('blog.tags.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Tag::class);
    }
}
