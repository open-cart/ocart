<?php

namespace Ocart\Core\Forms\Fields;

use Botble\Assets\Facades\AssetsFacade;
use Kris\LaravelFormBuilder\Fields\FormField;

class MediaImageField extends FormField
{

    /**
     * @return string
     */
    protected function getTemplate()
    {
        AssetsFacade::addStylesDirectly([
        'vendor/packages/media/css/app.css',
    ])
        ->addScriptsDirectly([
            'vendor/packages/media/js/app.js',
        ]);
        return 'core/base::forms.fields.media-image';
    }
}