<?php


namespace Ocart\Setting;


use Illuminate\Foundation\Application;
use Illuminate\Support\Manager;

class SettingManager extends Manager
{

    /**
     * @var Application
     */
    protected $container;

    /**
     * @return string
     */
    public function getDefaultDriver()
    {
        return config('core.setting.general.driver');
    }

    /**
     * @return JsonSettingStore
     */
    public function createJsonDriver()
    {
        return new JsonSettingStore($this->app['files']);
    }

    /**
     * @return DatabaseSettingStore
     */
    public function createDatabaseDriver()
    {
        $connection = $this->container->make('db.connection');
        $table = 'settings';
        $keyColumn = 'key';
        $valueColumn = 'value';

        return new DatabaseSettingStore($connection, $table, $keyColumn, $valueColumn);
    }
}
