<?php
namespace Ocart\Blog\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Blog\Forms\Fields\CategoryMultiField;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Page\Supports\Template;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;
use Assets;

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
            ->withCustomFields()
            ->setModuleName('blog')
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'label'      => trans('packages/page::pages.forms.name'),
                'rules' => 'min:3',
            ])
            ->add('slug', Field::TEXT, [
                'rules' => 'min:3',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:5000',
                'attr' => [
                    'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-inline'
                ]
            ])
            ->add('content', Field::TEXTAREA, [
                'rules' => 'max:5000',
                'attr' => [
                    'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-full'
                ]
            ])
            ->add('is_featured', 'onOff')
            ->add('status', 'select', [
                'choices'    => BaseStatusEnum::labels()
            ])
            ->add('categories[]', 'categoryMulti', [
                'label'      =>'Category',
                'choices'    => get_blog_categories(),
                'value'      => old('categories', $selectedCategories),
            ])
            ->add('format_type', 'select', [
                'choices'    => \Arr::pluck(get_post_formats(false), 'name', 'key')
            ])->add('image', 'mediaImage', [
                'label'      => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('is_featured');
    }
}
