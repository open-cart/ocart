<?php
namespace Ocart\Ecommerce\Table;

use Collective\Html\HtmlBuilder;
use Ocart\Ecommerce\Models\Tag;
use Ocart\Ecommerce\Repositories\Interfaces\CurrencyRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class CurrencyTable extends TableAbstract
{
    public function __construct(DataTables $table, CurrencyRepository $repo, HtmlBuilder $html)
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
            'title' => [
                'name' => 'title',
                'title' => trans('plugins/ecommerce::currency.title'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return "<span>{$item->title}</span><p class='text-xs'>{$item->description}</p>";
                }
            ],
            'symbol' => [
                'name' => 'symbol',
                'title' => trans('plugins/ecommerce::currency.symbol'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->symbol;
                }
            ],
            'exchange_rate' => [
                'name' => 'exchange_rate',
                'title' => trans('plugins/ecommerce::currency.exchange_rate'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->exchange_rate;
                }
            ],
            'number_of_decimals' => [
                'name' => 'number_of_decimals',
                'title' => trans('plugins/ecommerce::currency.number_of_decimals'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->decimals;
                }
            ],
            'position_of_symbol' => [
                'name' => 'position_of_symbol',
                'title' => trans('plugins/ecommerce::currency.position_of_symbol'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->is_prefix_symbol;
                }
            ],
            'thousands_separator' => [
                'name' => 'thousands_separator',
                'title' => trans('plugins/ecommerce::currency.thousands_separator'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->thousands_separator;
                }
            ],
            'decimal_separator' => [
                'name' => 'decimal_separator',
                'title' => trans('plugins/ecommerce::currency.decimal_separator'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->decimal_separator;
                }
            ],

            'order' => [
                'name' => 'order',
                'title' => trans('plugins/ecommerce::currency.order'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->order;
                }
            ],
            'is_default' => [
                'name' => 'is_default',
                'title' => trans('plugins/ecommerce::currency.is_default'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->is_default == 1 ? '<i class="fa fa-star"></i>' : '';
                }
            ],
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions('ecommerce.currencies.update', 'ecommerce.currencies.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('ecommerce.currencies.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Tag::class);
    }
}
