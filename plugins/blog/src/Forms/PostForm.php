<?php
namespace Ocart\Blog\Forms;

use Ocart\Blog\Forms\Fields\CategoryMultiField;
use Ocart\Blog\Forms\Fields\TagField;
use Ocart\Blog\Models\Post;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Core\Forms\Field;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class PostForm extends FormAbstract
{

    public function buildForm()
    {

        $this->formHelper->addCustomField('categoryMulti', CategoryMultiField::class);

        $selectedCategories = [];
        if ($this->getModel()) {
            $selectedCategories = $this->getModel()->categories()->pluck('category_id')->all();
        }

        if (empty($selectedCategories)) {
            /** @var $repo CategoryRepository */
            $repo = app(CategoryRepository::class);

            $selectedCategories = $repo->findWhere(['is_default' => 1])->pluck('id');
        }

        $this
            ->setupModel(new Post())
            ->withCustomFields()
            ->setModuleName('blog_post')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->addCustomField('tags', TagField::class)
            ->add('name', Field::TEXT, [
                'label'      => trans('plugins/blog::posts.name'),
                'rules' => 'min:3',
            ])
            ->add('slug', Field::TEXT, [
                'label'      => trans('admin.alias'),
                'rules' => 'min:3',
            ])
            ->add('description', Field::EDITOR, [
                'label'      => trans('plugins/blog::posts.description'),
                'attr' => [
                    'inline' => true
                ]
            ])
            ->add('content', Field::EDITOR, [
                'label'      => trans('plugins/blog::posts.content'),
            ])
            ->add('is_featured', 'onOff', [
                'label'      => trans('plugins/blog::posts.is_featured'),
            ])
            ->add('tags[]', 'tags', [
                'label'      => trans('Tags')
            ])
            ->add('status', 'select', [
                'label'      => trans('admin.status'),
                'choices'    => BaseStatusEnum::labels()
            ])
            ->add('categories[]', 'categoryMulti', [
                'label'      => trans('plugins/blog::posts.categories'),
                'choices'    => get_blog_categories(),
                'value'      => old('categories', $selectedCategories),
            ])

            ->add('format_type', 'select', [
                'label'      => trans('plugins/blog::posts.type'),
                'choices'    => \Arr::pluck(get_post_formats(false), 'name', 'key')
            ])->add('image', 'mediaImage', [
                'label'      => trans('plugins/blog::posts.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('is_featured');
    }
}
