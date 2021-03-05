<?php
namespace Ocart\Page\Supports;


use Illuminate\Support\Facades\File;

class Template
{

    /**
     * @param array $templates
     */
    public static function registerTemplate($templates = [])
    {
        $validTemplates = [];
        foreach ($templates as $key => $template) {
            if (self::exists($key)) {
                $validTemplates[$key] = $template;
            }
        }

        config([
            'packages.page.general.templates' => array_merge(config('packages.page.general.templates'),
                $validTemplates),
        ]);
    }

    /**
     * @return array
     */
    public static function getTemplate()
    {
        return config('packages.page.general.templates', []);
    }

    /**
     * @param $template
     * @return bool
     */
    public static function exists($template)
    {
        $folder = theme_path(setting('theme') . DIRECTORY_SEPARATOR . 'views/layouts' . DIRECTORY_SEPARATOR);

        $file = $folder . $template .'.blade.php';

        if (File::exists($file)) {
            return true;
        }

        return false;
    }
}
