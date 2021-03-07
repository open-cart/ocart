<?php


namespace Ocart\Ecommerce\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class CategoryMultiField extends FormField
{

    protected function getTemplate()
    {

        return 'plugins/ecommerce::categories.categories-multi';
    }
}
