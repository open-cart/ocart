<?php

namespace Ocart\Blog\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class TagField extends FormField
{

    protected function getTemplate()
    {
        return 'plugins.blog::posts.post-with-tags';
    }
}