<?php

namespace Ocart\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('mediaImage', 'core/base::elements.forms.image', [
            'name',
            'value'      => null,
            'attributes' => [],
        ]);

        Form::component('mediaImages', 'core/base::elements.forms.images', [
            'name',
            'value'      => null,
            'attributes' => [],
        ]);

        Form::component('tinymce', 'core/base::forms.partials.tinymce', [
            'name',
            'value'      => null,
            'attributes' => [],
        ]);
    }
}
