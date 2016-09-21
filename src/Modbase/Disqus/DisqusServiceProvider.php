<?php

namespace Modbase\Disqus;

use Illuminate\Support\ServiceProvider;

class DisqusServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/disqus-sso.php' => config_path('disqus-sso.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Disqus::class, function () {
            return new Disqus(config('disqus-sso.public'), config('disqus-sso.private'));
        });

        $this->mergeConfigFrom(__DIR__ . '/../../config/disqus-sso.php', 'disqus-sso');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Disqus::class
        ];
    }
}
