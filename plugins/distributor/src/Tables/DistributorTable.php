<?php
namespace Ocart\Distributor\Tables;

use Collective\Html\HtmlBuilder;
use Ocart\Distributor\Models\Distributor;
use Ocart\Distributor\Repositories\Interfaces\DistributorRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class DistributorTable extends TableAbstract
{
    public function __construct(DataTables $table, DistributorRepository $repo, HtmlBuilder $html)
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
            'name' => [
                'name' => 'name',
                'title' => trans('plugins/distributor::distributor.name'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
            'address' => [
                'name' => 'address',
                'title' => trans('plugins/distributor::distributor.address'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->address;
                }
            ],
            'phone' => [
                'name' => 'phone',
                'title' => trans('plugins/distributor::distributor.phone'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->phone;
                }
            ],
            'location' => [
                'name' => 'location',
                'title' => trans('plugins/distributor::distributor.location'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->position->name;
                }
            ],
            'created_at' => [
                'name' => 'created_at',
                'title' => trans('plugins/distributor::distributor.created_at'),
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
                    return $this->tableActions('distributors.update', 'distributors.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('distributors.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Distributor::class);
    }
}
