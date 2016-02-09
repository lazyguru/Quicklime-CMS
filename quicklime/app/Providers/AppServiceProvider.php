<?php

namespace Quicklime\Providers;

use Blade;
use Quicklime\Cms\Cms;
use Quicklime\Md\Parser;
use Quicklime\Md\Compiler;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;
use Quicklime\Navigation as QuicklimeNavigation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;

        /*
         * Load CMS configuration
         */
        $this->mergeConfigFrom(cms_path('config/quicklime.php'), 'quicklime');
        $this->overrideConfigFrom(cms_path('config/app.php'), 'app');

        /*
         * Load translations from cms/lang directory
         */
        $this->loadTranslationsFrom(cms_path('lang') ,'quicklime');

        $app->view->addLocation(cms_theme('html'));
        $app->view->addLocation(cms_path('menus'));

        /*
         * Register MdCompiler
         */
        $app->view->getEngineResolver()->register('md', function () use ($app) {
            $compiler = $app['mdcompiler'];
            return new CompilerEngine($compiler);
        });
        $app->view->addExtension('md', 'md');

        if (\File::exists(cms_theme('boot.php'))) {
            require cms_theme('boot.php');
        }

        if (\File::exists(cms_theme('config.php'))) {
            $this->mergeConfigFrom(cms_theme('config.php'), 'quicklime.theme');
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mdparser', function ($app) {
            return new Parser();
        });

        $this->app->singleton('mdcompiler', function ($app) {
            $files = $app['files'];
            $storagePath = storage_path('app/cms/');
            return new Compiler($files, $storagePath);
        });
        $this->app->alias('mdcompiler', Compiler::class);

        $this->app->bind(
            'quicklime::navigation',
            function ($app) {
                return new QuicklimeNavigation($app->make('url'));
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'mdcompiler',
            'mdparser',
            'quicklime::navigation',
        ];
    }

    /**
     * Merge the configurations. Quicklime `app` config will override Laravel's
     * @param string $path
     * @param string $key
     */
    protected function overrideConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge($config, require $path));
    }
}
