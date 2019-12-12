<?php
namespace enconte\afipws;

use Exception;
use enconte\afipws\WSFE\Wsfe;
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

        // Bind the PHPExcel class
        $this->app->singleton('wsfe', function ()
        {
            // Init WSFE
            $wsfe = new Wsfe();
            return $wsfe;
        });

        $this->app->alias('wsfe', Wsfe::class);
    }

    public function boot()
    {
        $configPath = __DIR__.'/../config/afipws.php';
        $this->publishes([$configPath => config_path('afipws.php')], 'config');
    }

}
