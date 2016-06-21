<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:32
 */

namespace Andersonef\AvalonAdmin\Providers;


use Andersonef\AvalonAdmin\Commands\DownCommand;
use Andersonef\AvalonAdmin\Commands\UpCommand;
use Andersonef\AvalonAdmin\Http\Controllers\AuthController;
use Andersonef\AvalonAdmin\Http\Controllers\Panel\DashboardController;
use Andersonef\AvalonAdmin\Http\Controllers\Panel\UsersController;
use Andersonef\AvalonAdmin\Http\Middlewares\AuthMiddleware;
use Andersonef\AvalonAdmin\Models\User;
use Andersonef\AvalonAdmin\Services\Core\UserService;
use Andersonef\AvalonAdmin\Services\WebsiteService;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
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

        $router->group(['middleware' => 'web'], function() use($router){
            $router->group(['prefix' => config('adminPath', 'avalon/admin')], function() use ($router){
                $router->group(['prefix' => 'panel', 'middleware' => AuthMiddleware::class], function() use ($router) {
                    //dashboard
                    $router->resource('/', DashboardController::class, ['only' => ['index'], 'names' => [
                        'index'     => 'avalon.admin.panel.dashboard.index',
                    ]]);

                    //User Management
                    $router->resource('/users', UsersController::class, ['names' => [
                        'index'     => 'avalon.admin.panel.users.index',
                        'create'    => 'avalon.admin.panel.users.create',
                        'store'     => 'avalon.admin.panel.users.store',
                        'update'    => 'avalon.admin.panel.users.update',
                        'edit'      => 'avalon.admin.panel.users.edit',
                        'destroy'   => 'avalon.admin.panel.users.destroy',
                    ]]);
                });
                $router->resource('/', AuthController::class, ['only' => ['index','store'], 'names' => ['index' => 'avalon.admin.auth.index', 'store' => 'avalon.admin.auth.store']]);
            });
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
        if(!config('auth.providers.avalon-admin')) {
            config(['auth.providers.avalon-admin' => ['driver' => 'eloquent', 'model' => User::class]]);
            config(['auth.guards.avalon-admin' => ['driver' => 'session', 'provider' => 'avalon-admin']]);
        }

        $this->commands([UpCommand::class, DownCommand::class]);

        //Injecting dependencies:
        $this->app->when(UserService::class)->needs(Guard::class)->give(function(){
            return \Auth::guard('avalon-admin');
        });
    }
}