<?php


namespace Ocart\Theme;


use Illuminate\Support\Arr;
use Illuminate\View\Factory;

class ThemeConfig
{
    /**
     * @var string
     */
    protected $namespace = 'theme';

    /**
     * @var Factory
     */
    protected $view;

    /**
     * @var
     */
    protected $adminConfig;

    public function __construct(Factory $view)
    {
        $this->view = $view;
        self::uses(self::getConfig('theme', 'ripple'));
    }

    /**
     * @return string
     */
    public function path()
    {
        return base_path();
    }

    /**
     * @param null $theme
     */
    public function uses($theme = null)
    {

        $this->view->addNamespace($this->getThemeNamespace(), [base_path('themes/'.$theme.'/views')]);
    }

    /**
     * @param $view
     * @param array $args
     * @param null $default
     * @return \Illuminate\Contracts\View\View
     */
    public function scope($view, $args = [], $default = null)
    {
        return $this->view->make($this->getThemeNamespace($view), $args);
    }

    /**
     * Get theme namespace.
     *
     * @param string $path
     *
     * @return string
     */
    public function getThemeNamespace($path = '')
    {
        // Namespace relate with the theme name.
        $namespace = $this->namespace;

        if ($path != false) {
            return $namespace . '::' . $path;
        }

        return $namespace;
    }

    /**
     * @param $key
     * @param null $default
     * @return string
     */
    public function getConfig($key, $default = null)
    {
        if (!$this->adminConfig) {
            $this->adminConfig = setting();
        }

        return Arr::get($this->adminConfig, $key, $default);
    }
}
