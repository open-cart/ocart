<?php

namespace Ocart\Ecommerce\Table;

use Collective\Html\HtmlBuilder;
use Kris\LaravelFormBuilder\FormBuilder;
use Ocart\Ecommerce\Models\Tag;
use Ocart\Ecommerce\Repositories\Criteria\OrderSearchCriteria;
use Ocart\Ecommerce\Repositories\Interfaces\OrderRepository;
use Ocart\Ecommerce\Forms\OrderFilterForm;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class OrderTable extends TableAbstract
{
    public function __construct(DataTables $table, OrderRepository $repo, HtmlBuilder $html, FormBuilder $formBuilder)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $repo->orderBy('id', 'desc')
            ->pushCriteria(OrderSearchCriteria::class)
            ->with([
                'payment',
                'user',
                'address'
            ])->paginate();
        $this->ajax();

        $this->searchForm = $formBuilder->create(OrderFilterForm::class, ['model' => request()->all()])
            ->renderForm();
    }

    public function ajax()
    {
        $data = $this->table->columns([
            'id' => [
                'name' => 'id',
                'title' => 'Order',
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return '<a href="' . route('ecommerce.orders.update', ['id' => $item->id]) . '" class="text-blue-500 font-bold">' . $item->code . '</a>';
                }
            ],
            'customer' => [
                'name' => 'customer',
                'title' => 'Khách hàng',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->user->name ?? $item->address->name;
                }
            ],
            'amount' => [
                'name' => 'amount',
                'title' => 'Amount',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return format_price($item->amount);
                }
            ],
            'tax_amount' => [
                'name' => 'alias',
                'title' => 'Tax amount',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return format_price($item->tax_amount);
                }
            ],
            'shipping_amount' => [
                'name' => 'alias',
                'title' => 'Ship amount',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return format_price($item->shipping_amount);
                }
            ],
            'payment_method' => [
                'name' => 'alias',
                'title' => 'Payment method',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->payment->payment_channel->toHtml();
                }
            ],
            'payment_status' => [
                'name' => 'alias',
                'title' => 'Payment status',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->payment->status->toHtml();
                }
            ],
            'status' => [
                'name' => 'status',
                'title' => __('admin.status'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->status->toHtml();
                }
            ],

            'created_at' => [
                'name' => 'created_at',
                'title' => 'Ngày tạo',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->created_at;
                }
            ]
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
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
