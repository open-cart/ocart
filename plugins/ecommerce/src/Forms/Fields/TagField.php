<?php

namespace Ocart\Ecommerce\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class TagField extends FormField
{

    protected function getTemplate()
    {
        return 'plugins.ecommerce::products.product-with-tags';
    }
}
