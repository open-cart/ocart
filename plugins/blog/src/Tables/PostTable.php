<?php
namespace Ocart\Blog\Tables;

use Collective\Html\HtmlBuilder;
use Kris\LaravelFormBuilder\FormBuilder;
use Ocart\Blog\Exports\PostExport;
use Ocart\Blog\Forms\PostFilterForm;
use Ocart\Blog\Repositories\Criteria\BlogSearchCriteria;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Media\Facades\TnMedia;
use Ocart\Page\Models\Page;
use Ocart\Table\Abstracts\TableAbstract;
use Ocart\Table\DataTables;

class PostTable extends TableAbstract
{
    /**
     * Export class handler.
     *
     * @var string
     */
    protected $exportClass = PostExport::class;


    public function __construct(DataTables $table, PostRepository $repo, HtmlBuilder $html, FormBuilder $formBuilder)
    {
        parent::__construct($table, $html);
        $this->_table = $table;
        $this->repository = $repo;
        $this->data = $this->query();
        $this->ajax();

        $this->searchForm = $formBuilder->create(PostFilterForm::class, ['model' => request()->all()])
            ->renderForm();
    }

    public function query()
    {
        $this->repository
            ->with('categories:id,name')
            ->pushCriteria(BlogSearchCriteria::class);
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
                'title' => trans('plugins/blog::posts.image'),
                'width' => '120px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    if ($this->request()->input('action') === 'excel') {
                        return TnMedia::getImagePath($item->image, 'thumb', asset('/images/no-image.jpg'));
                    }

                    return '<img src="' . TnMedia::url($item->image ?? asset('/images/no-image.jpg')) . '" alt="' . $item->title . '" class="w-14"/>';
                }
            ],
            'title' => [
                'name' => 'title',
                'title' => trans('plugins/blog::posts.name'),
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    if ($this->request()->input('action') === 'excel') {
                        return $item->name;
                    }

                    $link = route('blog.posts.update', ['id' => $item->id]);
                    return "<a class='text-blue-400' href='$link'>$item->name</a>";
                }
            ],
            'categories' => [
                'name' => 'id',
                'title' => trans('plugins/blog::posts.categories'),
                'width' => '180px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return join(',', $item->categories->pluck('name')->toArray());
                }
            ],
            'created_at' => [
                'name' => 'created_at',
                'title' => trans('admin.created_at'),
                'width' => '180px',
                'class' => 'border text-left px-2 py-2 dark:text-gray-300 dark:border-gray-700',
                'render' => function ($item) {
                    return $item->created_at->format('Y-m-d H:i:s');
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
                    return $this->tableActions('blog.posts.update', 'blog.posts.destroy', $item);
                }
            ]);
    }

    public function buttons()
    {
        $buttons = $this->addCreateButton(route('blog.posts.create'), []);

        return apply_filters('base_table_action', $buttons, Page::class);
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
