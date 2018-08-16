<?php

namespace Betterde\Deployment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * DeploymentServiceProvider
 *
 * Date: 2018/8/16
 * @author George
 * @package Betterde\Deployment\Providers
 */
class DeploymentServiceProvider extends ServiceProvider
{
    /**
     * Define namespace
     *
     * @var string
     * Date: 2018/8/16
     * @author George
     */
    protected $namespace = 'Betterde\Deployment\Http\Controllers';

    /**
     * Date: 2018/8/16
     * @author George
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/deployment.php' => config_path('deployment.php'),
        ], 'deployment-config');

        $this->registerRoutes();
    }

    /**
     * Register routers
     *
     * Date: 2018/8/16
     * @author George
     */
    protected function registerRoutes()
    {
        if (config('deployment.enable')) {
            Route::group(['prefix' => config('deployment.uri', 'deployment'), 'namespace' => $this->namespace], function () {
                $this->loadRoutesFrom(__DIR__.'/../../routes/hooks.php');
            });
        }
    }

    /**
     * Date: 2018/8/16
     * @author George
     */
    public function register()
    {

    }
}
