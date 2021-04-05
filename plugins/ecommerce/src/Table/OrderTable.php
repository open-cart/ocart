<?php
namespace Ocart\Ecommerce\Table;

use Collective\Html\HtmlBuilder;
use Ocart\Ecommerce\Models\Tag;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class OrderTable extends TableAbstract
{
    public function __construct(DataTables $table, OrderRepository $repo, HtmlBuilder $html)
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
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->id;
                }
            ],
            'customer' => [
                'name' => 'customer',
                'title' => 'Khách hàng',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->slug;
                }
            ],
            'amount' => [
                'name' => 'amount',
                'title' => 'Amount',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return format_price($item->amount);
                }
            ],
            'tax_amount' => [
                'name' => 'alias',
                'title' => 'Tax amount',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return 0;
                }
            ],
            'shipping_amount' => [
                'name' => 'alias',
                'title' => 'Ship amount',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return 0;
                }
            ],
            'payment_method' => [
                'name' => 'alias',
                'title' => 'Payment method',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return 'COD';
                }
            ],
            'payment_status' => [
                'name' => 'alias',
                'title' => 'Payment status',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return 'status';
                }
            ],
            'status' => [
                'name' => 'status',
                'title' => __('admin.status'),
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->status->toHtml();
                }
            ],

            'created_at' => [
                'name' => 'created_at',
                'title' => 'Ngày tạo',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->created_at;
                }
            ]
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions('ecommerce.orders.update', 'ecommerce.orders.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('ecommerce.orders.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Tag::class);
    }
}
