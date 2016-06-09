<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:32
 */

namespace Andersonef\AvalonAdmin\Providers;


use Andersonef\AvalonAdmin\Commands\InstallCommand;
use Andersonef\AvalonAdmin\Models\User;
use Andersonef\AvalonAdmin\Services\WebsiteService;
use Illuminate\Support\ServiceProvider;

class AvalonAdminProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../assets'     => public_path('/avalon-admin-assets')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Client.AvalonWebsiteService', WebsiteService::class);

        //Registering lang and views namespaces:
        \View::addNamespace('AvalonAdmin', __DIR__.'/../../resources/views');
        \Lang::addNamespace('AvalonAdmin', __DIR__.'/../../resources/lang');

        //Setting a new authentication driver:
        config(['auth.providers.avalon-admin' => ['driver' => 'eloquent', 'model' => User::class]]);
        config(['auth.guards.avalon-admin' => ['driver' => 'session', 'provider' => 'avalon-admin']]);

        $this->commands([InstallCommand::class]);
    }
}