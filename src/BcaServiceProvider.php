<?php

namespace Odenktools\Bca;

use Bca\BcaHttp;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;

/**
 * Laravel BCA REST API Library.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
class BcaServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/bca.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('bca.php')]);
        }

        $this->mergeConfigFrom($source, 'bca');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('bca.factory', function () {
            return new BcaFactory();
        });

        $this->app->alias('bca.factory', BcaFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('bca', function (Container $app) {
            $config  = $app['config'];
            $factory = $app['bca.factory'];
            return new BcaManager($config, $factory);
        });

        $this->app->alias('bca', BcaManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('bca.connection', function (Container $app) {
            $manager = $app['bca'];

            return $manager->connection();
        });

        $this->app->alias('bca.connection', BcaHttp::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'bca',
            'bca.factory',
            'bca.connection',
        ];
    }
}
