<?php
namespace Ocart\Ecommerce\Table;

use Collective\Html\HtmlBuilder;
use Ocart\Core\Supports\SortItemsWithChildrenSupport;
use Ocart\Ecommerce\Models\Tag;
use Ocart\Ecommerce\Repositories\Interfaces\CategoryRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class CategoryTable extends TableAbstract
{
    public function __construct(DataTables $table, CategoryRepository $repo, HtmlBuilder $html)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;

        $categories = $repo->orderBy($repo->getModel()->qualifyColumn('created_at'), 'ASC')->all();

        /** @var SortItemsWithChildrenSupport $sortSupport */
        $sortSupport = app(SortItemsWithChildrenSupport::class);

        $list = $sortSupport->setItems($categories)->setChildrenProperty('child_cats')->sort();

        $categories = sort_item_with_children($list);

        $indent = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

        foreach ($categories as $category) {
            $indentText = '';
            $depth = (int)$category->depth;
            for ($i = 0; $i < $depth; $i++) {
                $indentText .= $indent;
            }
            $category->indent_text = $indentText;
        }

        $this->data = $categories;
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
                    return '<a href="'.route('ecommerce.categories.update', ['id' => $item->id]).'" class="text-blue-600">' . $item->indent_text .($item->depth > 0 ? '|--' : ''). $item->name .'</a>';
                }
            ],
//            'image' => [
//                'name' => 'id',
//                'title' => 'image',
//                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
//                'render' => function ($item) {
//                    return '<img src="' . ($item->image ?? '/images/no-image.jpg') . '" alt="' . $item->title . '" class="w-14"/>';
//                }
//            ],
            'alias' => [
                'name' => 'alias',
                'title' => __('admin.alias'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->slug;
                }
            ],
            'craeteAt' => [
                'name' => 'created_at',
                'title' => __('admin.created_at'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->created_at;
                }
            ],
            'featured' => [
                'name' => 'featured',
                'title' => __('admin.featured'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'width' => '120px',
                'render' => function ($item) {
                    return $item->is_featured;
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
                    return $this->tableActions('ecommerce.categories.update', 'ecommerce.categories.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('ecommerce.categories.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Tag::class);
    }
}
