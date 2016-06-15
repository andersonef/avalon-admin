<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:32
 */

namespace Andersonef\AvalonAdmin\Providers;


use Andersonef\AvalonAdmin\Commands\InstallCommand;
use Andersonef\AvalonAdmin\Http\Controllers\AuthController;
use Andersonef\AvalonAdmin\Models\User;
use Andersonef\AvalonAdmin\Services\WebsiteService;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class AvalonAdminProvider extends ServiceProvider
{

    public function boot(Router $router)
    {
        parent::boot($router);
        $this->publishes([
            __DIR__.'/../../assets'     => public_path('/avalon-admin-assets')
        ]);

        //Registering lang and views namespaces:
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'AvalonAdmin');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'AvalonAdmin');
    }



    public function map(Router $router)
    {

        $router->group(['prefix' => config('adminPath', 'avalon/admin')], function() use ($router){
            $router->resource('/', AuthController::class, ['only' => ['index','store']]);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Client.AvalonWebsiteService', WebsiteService::class);



        //Setting a new authentication driver:
        config(['auth.providers.avalon-admin' => ['driver' => 'eloquent', 'model' => User::class]]);
        config(['auth.guards.avalon-admin' => ['driver' => 'session', 'provider' => 'avalon-admin']]);

        $this->commands([InstallCommand::class]);
    }
}