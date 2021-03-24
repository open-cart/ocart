<?php
namespace Ocart\Blog\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Page\Supports\Template;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;
use Assets;

class PostForm extends FormAbstract
{

    public function buildForm()
    {
//        Assets::addScripts(['tnmedia'])->addStyles(['tnmedia']);

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
                'rules' => 'max:5000'
            ])
            ->add('content', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])
            ->add('is_featured', 'onOff')
            ->add('status', 'select', [
                'choices'    => BaseStatusEnum::labels()
            ])->add('format_type', 'select', [
                'choices'    => \Arr::pluck(get_post_formats(false), 'name', 'key')
            ])->add('image', 'mediaImage', [
                'label'      => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('is_featured');
    }
}
