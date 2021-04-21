<?php

namespace Ocart\Shortcode\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\ViewFinderInterface;
use Ocart\Core\Library\Helper;
use Ocart\Shortcode\Compilers\ShortcodeCompiler;
use Ocart\Shortcode\Shortcode;
use Ocart\Shortcode\View\Factory;

class ShortcodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->singleton('shortcode.compiler', ShortcodeCompiler::class);

        $this->app->singleton('shortcode', function ($app) {
            return new Shortcode($app['shortcode.compiler']);
        });

        $this->registerFactory();
    }

    /**
     * Register the view environment.
     *
     * @return void
     */
    public function registerFactory()
    {
        $this->app->singleton('view', function ($app) {
            // Next we need to grab the engine resolver instance that will be used by the
            // environment. The resolver will be used by an environment to get each of
            // the various engine implementations such as plain PHP or Blade engine.
            $resolver = $app['view.engine.resolver'];

            $finder = $app['view.finder'];

            /** @var Factory $factory */
            $factory = $this->createFactory($resolver, $finder, $app['events']);

            $factory->setShortcode($app['shortcode.compiler']);

            // We will also set the container instance on this view environment since the
            // view composers may be classes registered in the container, which allows
            // for great testable, flexible composers for the application developer.
            $factory->setContainer($app);

            $factory->share('app', $app);

            return $factory;
        });
    }

    /**
     * Create a new Factory Instance.
     *
     * @param  EngineResolver  $resolver
     * @param  ViewFinderInterface  $finder
     * @param  Dispatcher  $events
     * @return Factory
     */
    protected function createFactory($resolver, $finder, $events)
    {
        return new Factory($resolver, $finder, $events);
    }
}