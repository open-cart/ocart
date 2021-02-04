<?php


namespace App\Plugins\Blog;


use App\Plugins\ConfigBase;
use Core\Admin\Models\AdminConfig;

class AppConfig extends ConfigBase
{
    public function __construct()
    {
        $config = file_get_contents(__DIR__ . '/config.json');
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

    public function enable()
    {
        $return = ['error' => 0, 'msg' => ''];
        $process = (new AdminConfig)->where('key', $this->configKey)->update(['value' => self::ON]);
        if (!$process) {
            $return = ['error' => 1, 'msg' => 'Error enable'];
        }

        return [];
    }

    public function disable()
    {
        $return = ['error' => 0, 'msg' => ''];
        $process = (new AdminConfig)->where('key', $this->configKey)->update(['value' => self::OFF]);
        if (!$process) {
            $return = ['error' => 1, 'msg' => trans('plugin.plugin_action.action_error', ['action' => 'Disable'])];
        }
        return $return;
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

    public function config()
    {
        return [1]; // TODO: Change the autogenerated stub
    }
}
