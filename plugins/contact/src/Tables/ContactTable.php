<?php
namespace Ocart\Contact\Tables;

use Collective\Html\HtmlBuilder;
use Ocart\Contact\Models\Contact;
use Ocart\Contact\Repositories\Interfaces\ContactRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class ContactTable extends TableAbstract
{
    public function __construct(DataTables $table, ContactRepository $repo, HtmlBuilder $html)
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
                'title' => trans('admin.name'),
                'with' => '20px',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
            'email' => [
                'name' => 'email',
                'title' => trans('admin.email'),
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->email;
                }
            ],
            'phone' => [
                'name' => 'phone',
                'title' => trans('admin.phone'),
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->phone;
                }
            ],
            'createdAt' => [
                'name' => 'created_at',
                'title' => 'Ngày tạo',
                'class' => 'border text-left px-2 py-2',
                'render' => function ($item) {
                    return $item->created_at;
                }
            ],
            'status' => [
                'name' => 'status',
                'title' => __('admin.status'),
                'class' => 'border text-left px-2 py-2',
                'width' => '120px',
                'render' => function ($item) {
                    return $item->status->toHtml();
                }
            ]
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2',
                'width' => '120px',
                'render' => function ($item) {
                    return $this->tableActions('contacts.update', 'contacts.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = []; //$this->addCreateButton(route('contacts.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Contact::class);
    }
}
