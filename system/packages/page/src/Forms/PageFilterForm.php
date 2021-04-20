<?php
namespace Ocart\Page\Forms;

use Kris\LaravelFormBuilder\Field;
use Ocart\Page\Models\Page;
use Ocart\Page\Supports\Template;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Forms\FormAbstract;

class PageFilterForm extends FormAbstract
{
    protected $template = 'core::forms.form-filter';

    public function buildForm()
    {
//        $this
//            ->setModuleName('page-filter')
////            ->setFormOption('class', 'space-y-4')
////            ->setFormOption('id', 'from-builder')
//            ->add('name', Field::TEXT, [
////                'label'      => 'label search',
//                'wrapper_class' => 'col-span-2'
//            ]);

        $this
            ->setModuleName('page-filter')->add('name', Field::TEXT, [
//                'label'      => 'label search',
                'wrapper_class' => 'col-span-2'
            ]);
    }
}
