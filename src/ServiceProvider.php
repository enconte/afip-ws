<?php
namespace Enconte\AFIPWS;

use Exception;
use Enconte\AFIPWS\WSFE\Wsfe;
use Enconte\AFIPWS\AFIP;
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

        // Bind the WSFE class
        $this->app->singleton('wsfe', function ()
        {
            // Init WSFE
            $wsfe = new Wsfe();
            return $wsfe;
        });

        $this->app->alias('wsfe', Wsfe::class);

        $this->app->singleton('afip', function ($app)
        {
            // Init AFIP
            $afip = new AFIP(
                $app['wsfe']
            );
            return $afip;
        });

        $this->app->alias('afip', AFIP::class);
    }

    public function boot()
    {
        $configPath = __DIR__.'/../config/afipws.php';
        $this->publishes([$configPath => config_path('afipws.php')], 'config');
    }

}
