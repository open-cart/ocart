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
     * @var string
     */
    protected $layout;

    /**
     * The name of theme.
     *
     * @var string
     */
    protected $theme;

    /**
     * @var
     */
    protected $adminConfig;

    public function __construct(Factory $view)
    {
        $this->view = $view;
        self::uses(setting('theme', 'ripple'))->layout(setting('layout', 'default'));
    }

    /**
     * Get current theme name.
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->theme;
    }

    /**
     * @param string $layout
     * @return ThemeConfig
     */
    public function layout(string $layout = 'default')
    {
        $this->layout = $layout;
        return $this;
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
     * @return ThemeConfig
     */
    public function uses($theme = null)
    {
        $this->theme = $theme;
        
        $this->view->addNamespace($this->getThemeNamespace(), [base_path('themes/'.$theme.'/views')]);
        return $this;
    }

    /**
     * @param $view
     * @param array $args
     * @param null $default
     * @return \Illuminate\Contracts\View\View
     */
    public function scope($view, $args = [], $default = null)
    {
        $path = $this->getThemeNamespace($view);
        if ($this->view->exists($path)) {
            return $this->view->make($this->getThemeNamespace($view), $args);
        }
        if ($default) {
            return $this->view->make($default, $args);
        }
    }

    /**
     * @param null $default
     * @return \Illuminate\Contracts\View\View
     */
    public function getLayout($default = null)
    {
        return $this->scope('layouts.' . $this->layout, [], $default);
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

    /**
     * @param string $path
     */
    protected function handleViewNotFound($path)
    {
        if (app()->isLocal()) {
            dd('Theme is not support this view, please create file ' . theme_path() . '/' . str_replace($this->getThemeNamespace(),
                    $this->getThemeName(),
                    str_replace('::', '/', str_replace('.', '/', $path))) . '.blade.php" to render this page!');
        } else {
            abort(404);
        }
    }

    /**
     * @param $path
     * @param null $secure
     * @return mixed
     */
    public function asset($path, $secure = null)
    {
        $path = trim($path, DIRECTORY_SEPARATOR);
        return app('url')->asset('themes/' . $this->theme . DIRECTORY_SEPARATOR . $path, $secure);
    }
}
