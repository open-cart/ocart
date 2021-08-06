<?php

namespace Ocart\Core\Forms\Fields;

use Botble\Assets\Facades\AssetsFacade;
use Kris\LaravelFormBuilder\Fields\FormField;

class EditorField extends FormField
{
    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'core/base::forms.fields.editor';
    }
}