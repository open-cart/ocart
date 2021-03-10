<?php


namespace Ocart\Core\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class OnOffField extends FormField
{

    protected function getTemplate()
    {
        return 'core/base::forms.fields.on-off';
    }
}
