<?php
namespace Ocart\Ecommerce;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Ocart\Setting\Facades\Setting;

class AppConfig extends \Ocart\PluginManagement\Abstracts\ConfigBase
{
    public function __construct()
    {
        $config = file_get_contents(__DIR__ . '/../plugin.json');
        $config = json_decode($config, true);

        $this->configGroup = $config['configGroup'];
        $this->configCode = $config['configCode'];
        $this->configKey = $config['configKey'];
        $this->pathPlugin = $this->configGroup . '/' . $this->configKey;
        $this->title = 'Blog';
        $this->image = $this->pathPlugin.'/'.$config['image'];
        $this->version = $config['version'];
        $this->auth = $config['auth'];
        $this->link = $config['link'];
    }

    public static function activate() {}

    public static function deactivate() {
        if (File::isDirectory(plugin_path('ecommerce/database/migrations'))) {
            Artisan::call('migrate:rollback', [
                '--force' => true,
                '--path'  => str_replace(base_path(), '', plugin_path('ecommerce/database/migrations')),
            ]);
        }
    }

    public function install()
    {
        // TODO: Implement install() method.
    }

    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }
}
