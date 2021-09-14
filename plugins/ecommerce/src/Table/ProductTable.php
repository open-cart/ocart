<?php
namespace Ocart\Ecommerce\Table;

use Collective\Html\HtmlBuilder;
use Kris\LaravelFormBuilder\FormBuilder;
use Ocart\Ecommerce\Exports\ProductExport;
use Ocart\Ecommerce\Forms\OrderFilterForm;
use Ocart\Ecommerce\Forms\ProductFilterForm;
use Ocart\Ecommerce\Models\Product;
use Ocart\Ecommerce\Repositories\Criteria\ProductSearchCriteria;
use Ocart\Ecommerce\Repositories\Interfaces\ProductRepository;
use Ocart\Media\Facades\TnMedia;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class ProductTable extends TableAbstract
{
    /**
     * Export class handler.
     *
     * @var string
     */
    protected $exportClass = ProductExport::class;

    public function __construct(DataTables $table, ProductRepository $repo, HtmlBuilder $html, FormBuilder $formBuilder)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $this->query();
        $this->ajax();

        $this->searchForm = $formBuilder->create(ProductFilterForm::class, ['model' => request()->all()])
            ->renderForm();
    }

    public function query()
    {
        $this->repository->pushCriteria(ProductSearchCriteria::class);
        $res = apply_filters(BASE_FILTER_TABLE_QUERY, $this->repository, []);
        if ($this->request()->input('action') === 'excel') {
            return $res->get();
        }

        return $res->paginate();
    }

    public function ajax()
    {
        $data = $this->table->columns([
            'image' => [
                'name' => 'id',
                'title' => 'image',
                'width' => '70',
                'class' => 'border text-center px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    if ($this->request()->input('action') === 'excel') {
                        return TnMedia::getImagePath($item->image, 'thumb', asset('/images/no-image.jpg'));
                    }

                    return '<img src="' . TnMedia::getImageUrl($item->image, 'thumb', asset('/images/no-image.jpg')) . '" alt="' . $item->title . '" class="w-14 m-auto"/>';
                }
            ],
            'name' => [
                'name' => 'name',
                'title' => 'title',
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    if ($this->request()->input('action') === 'excel') {
                        return $item->name;
                    }

                    return '<a class="text-blue-500" href="'.route('ecommerce.products.update', ['id' => $item->id]).'">'.$item->name.'</a>';
                }
            ],
            'price' => [
                'name' => 'price',
                'title' => 'Price',
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return format_price($item->price);
                }
            ],
            'sku' => [
                'name' => 'sku',
                'title' => 'Sku',
                'with' => '20px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->sku;
                }
            ],

            'alias' => [
                'name' => 'alias',
                'title' => 'URL Tùy chỉnh',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->slug;
                }
            ],
            'craeteAt' => [
                'name' => 'created_at',
                'title' => 'Ngày tạo',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->created_at->format('Y-m-d H:i:s');
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
                    if ($this->request()->input('action') === 'excel') {
                        return $item->status->getValue();
                    }

                    return $item->status->toHtml();
                }
            ]
        ]);
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('actions', [
                'title' => __('admin.action'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'width' => '120px',
                'exportable' => false,
                'render' => function ($item) {
                    return $this->tableActions('ecommerce.products.update', 'ecommerce.products.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('ecommerce.products.create'), []);

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Product::class);
    }

    /**
     * @return string[]
     */
    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
