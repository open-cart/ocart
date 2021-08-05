<?php
namespace Ocart\Payment\Tables;

use Collective\Html\HtmlBuilder;
use Kris\LaravelFormBuilder\FormBuilder;
use Ocart\Payment\Forms\PaymentTransactionFilterForm;
use Ocart\Payment\Models\Payment;
use Ocart\Payment\Repositories\Criteria\PaymentSearchCriteria;
use Ocart\Payment\Repositories\PaymentRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class PaymentTransactionTable extends TableAbstract
{
    public function __construct(DataTables $table, PaymentRepository $repo, HtmlBuilder $html, FormBuilder $formBuilder)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $repo->pushCriteria(PaymentSearchCriteria::class)->paginate();
        $this->ajax();

        $this->searchForm = $formBuilder->create(PaymentTransactionFilterForm::class, ['model' => request()->all()])
            ->renderForm();
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
                'name' => 'charge_id',
                'title' => trans('plugins/payment::payment.charge_id'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    $link = route('payments.transactions.update', ['id' => $item->id]);
                    return "<a class='text-blue-400' href='$link'>$item->charge_id</a>";
                }
            ],
            'amount' => [
                'name' => 'charge_id',
                'title' => trans('plugins/payment::payment.amount'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->amount;
                }
            ],
            'payment_channel' => [
                'name' => 'charge_id',
                'title' => trans('plugins/payment::payment.payment_channel'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->payment_channel->toHtml();
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
                    return $this->tableActions('payments.transactions.update', 'payments.transactions.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = []; //$this->addCreateButton(route('payments.transactions.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Payment::class);
    }
}
