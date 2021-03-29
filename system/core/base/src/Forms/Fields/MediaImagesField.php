<?php

namespace Ocart\Core\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class MediaImagesField extends FormField
{

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'core/base::forms.fields.media-images';
    }
}