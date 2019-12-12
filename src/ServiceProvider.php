<?php
namespace enconte\afipws;

use Exception;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @throws \Exception
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/afipws.php';
        $this->mergeConfigFrom($configPath, 'afipws');

        $this->app->bind('afipws.options', function(){
            $url = $this->app['config']->get('afipws.url');
            $url_production = $this->app['config']->get('afipws.url_production');
            $defines = array_merge($url,$url_production);

            if ($defines) {
                $options = [];
                foreach ($defines as $key => $value) {
                    $key = strtolower($key);
                    $options[$key] = $value;
                }
            } else {
                $options = $this->app['config']->get('afipws.options');
            }

            return $options;

        });

        $this->app->bind('afipws', function() {

            $options = $this->app->make('afipws.options');
            $afipws = new AFIPWS($options);

            return $afipws;
        });
        $this->app->alias('afipws', Afipws::class);

        $this->app->bind('afipws.wrapper', function ($app) {
            return new AFIP($app['afipws'], $app['config'], $app['files'], $app['view']);
        });

    }

    public function boot()
    {
        $configPath = __DIR__.'/../config/afipws.php';
        $this->publishes([$configPath => config_path('afipws.php')], 'config');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('afipws', 'afipws.options', 'afipws.wrapper');
    }

}
