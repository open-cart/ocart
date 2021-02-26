<?php


namespace Ocart\PluginManagement\Abstracts;


abstract class ConfigBase
{
    public $configGroup;
    public $configCode;
    public $configKey;
    public $title;
    public $version;
    public $scartVersion;
    public $auth;
    public $link;
    public $image;
    const ON = 1;
    const OFF = 0;
    const ALLOW = 1;
    const DENIED = 0;
    public $pathPlugin;

    /**
     * Install app
     */
    abstract public function install();

    /**
     * Uninstall app
     */
    abstract public function uninstall();

    public static function activate() {}

    public static function deactivate() {}

    /**
     * Get data app
     */
    abstract public function getData();

    /**
     * Config app
     */
    public function config()
    {
        return null;
    }

    /**
     * Config app
     */
    public function endApp()
    {
        return null;
    }
}
