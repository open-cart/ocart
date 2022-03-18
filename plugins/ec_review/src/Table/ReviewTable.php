<?php
namespace Ocart\EcommerceReview\Table;

use Collective\Html\HtmlBuilder;
use Ocart\EcommerceReview\Models\Review;
use Ocart\EcommerceReview\Repositories\ReviewRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class ReviewTable extends TableAbstract
{
    public function __construct(DataTables $table, ReviewRepository $repo, HtmlBuilder $html)
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
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->id;
                }
            ],
            'product' => [
                'name' => 'alias',
                'title' => 'product',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    if (!$item->product) {
                        return '--';
                    }
                    return '<a href="'. $item->product->url .'" class="blank text-blue-500" target="_blank">' . $item->product->name . '</a>';
                }
            ],
            'user' => [
                'name' => 'alias',
                'title' => 'user',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->customer->name;
                }
            ],
            'star' => [
                'name' => 'alias',
                'title' => 'Star',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->star;
                }
            ],
            'comment' => [
                'name' => 'alias',
                'title' => 'Comment',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->comment;
                }
            ],
            'created_at' => [
                'name' => 'created_at',
                'title' => __('admin.created_at'),
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
                'class' => 'border text-center px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions(null, 'ec_review.reviews.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = [];

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Review::class);
    }

}