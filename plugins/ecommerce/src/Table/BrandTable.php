<?php
namespace Ocart\Ecommerce\Table;

use Collective\Html\HtmlBuilder;
use Ocart\Ecommerce\Models\Tag;
use Ocart\Ecommerce\Repositories\Interfaces\BrandRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class BrandTable extends TableAbstract
{
    public function __construct(DataTables $table, BrandRepository $repo, HtmlBuilder $html)
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
                    return $this->tableActions('ecommerce.brands.update', 'ecommerce.brands.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('ecommerce.brands.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Tag::class);
    }
}
