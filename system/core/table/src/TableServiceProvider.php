<?php
namespace Ocart\Table;

use Illuminate\Support\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core/table');
    }
}
