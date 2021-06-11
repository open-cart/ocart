<?php
namespace Ocart\Attribute\Tables;

use Collective\Html\HtmlBuilder;
use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class AttributeGroupTable extends TableAbstract
{
    public function __construct(DataTables $table, AttributeGroupRepository $repo, HtmlBuilder $html)
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
                'name' => 'title',
                'title' => trans('plugins/attribute::attributes.title'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    $link = route('ecommerce.attribute_groups.update', ['id' => $item->id]);
                    return "<a class='text-blue-400' href='$link'>$item->title</a>";
                }
            ],
            'slug' => [
                'name' => 'slug',
                'title' => trans('plugins/attribute::attributes.slug'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    $link = route('ecommerce.attribute_groups.update', ['id' => $item->id]);
                    return "<a class='text-blue-400' href='$link'>$item->slug</a>";
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
                    return $this->tableActions('ecommerce.attribute_groups.update', 'ecommerce.attribute_groups.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('ecommerce.attribute_groups.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, AttributeGroup::class);
    }
}
