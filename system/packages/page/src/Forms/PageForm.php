<?php
namespace Ocart\Page\Forms;

use Kris\LaravelFormBuilder\Field;
use System\Core\Forms\FormAbstract;

class PageForm extends FormAbstract
{

    public function buildForm()
    {
        $this
            ->setFormOption('class', 'space-y-4')
            ->setFormOption('id', 'from-builder')
            ->add('name', Field::TEXT, [
                'rules' => 'min:5',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])
            ->add('content', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])
//            ->add('status', Field::TEXTAREA, [
//                'rules' => 'max:5000'
//            ])
//            ->add('description', Field::TEXTAREA, [
//                'rules' => 'max:5000'
//            ])
//            ->add('description', Field::TEXTAREA, [
//                'rules' => 'max:5000'
//            ])
//
            ->add('status', Field::CHECKBOX);
//            ->add('submit', Field::BUTTON_SUBMIT);
    }
}
