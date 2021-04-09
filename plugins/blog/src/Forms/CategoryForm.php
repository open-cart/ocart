<?php
namespace Ocart\Blog\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Blog\Models\Category;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class CategoryForm extends FormAbstract
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm()
    {
        $list = $this->categoryRepository->all();

        $categories = [];
        foreach ($list as $row) {
            if ($this->getModel() && $this->model->id === $row->id) {
                continue;
            }

            $categories[$row->id] = $row->indent_text . ' ' . $row->name;
        }
        $categories = [0 => 'None'] + $categories;

        $this
            ->setupModel(new Category())
            ->withCustomFields()
            ->setModuleName('blog_category')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/ecommerce::products.forms.name'),
//                'rules' => 'min:5',
            ])
            ->add('parent_id', 'select', [
                'choices'    => $categories
            ])
            ->add('slug', Field::TEXT, [
//                'rules' => 'min:5',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:400',
                'attr' => [
                    'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-inline'
                ]
            ])

            ->add('status', 'select', [
                'choices'    => BaseStatusEnum::labels()
            ])
            ->setBreakFieldPoint('status');
    }
}
