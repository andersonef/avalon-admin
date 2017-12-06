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
use Andersonef\AvalonAdmin\Facades\Website;
use Andersonef\AvalonAdmin\Http\Controllers\AuthController;
use Andersonef\AvalonAdmin\Http\Controllers\Panel\CategoriesController;
use Andersonef\AvalonAdmin\Http\Controllers\Panel\DashboardController;
use Andersonef\AvalonAdmin\Http\Controllers\Panel\ParametersController;
use Andersonef\AvalonAdmin\Http\Controllers\Panel\UsersController;
use Andersonef\AvalonAdmin\Http\Middlewares\AuthMiddleware;
use Andersonef\AvalonAdmin\Models\Category;
use Andersonef\AvalonAdmin\Models\Parameter;
use Andersonef\AvalonAdmin\Models\User;
use Andersonef\AvalonAdmin\Services\CategoryService;
use Andersonef\AvalonAdmin\Services\Core\UserService;
use Andersonef\AvalonAdmin\Services\ParameterService;
use Andersonef\AvalonAdmin\Services\WebsiteService;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class AvalonAdminProvider extends ServiceProvider
{

    public function boot()
    {
        parent::boot();
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
            $router->group(['prefix' => config('avalon-admin.adminPath', 'avalon/admin')], function() use ($router){
                $router->group(['prefix' => 'panel', 'middleware' => AuthMiddleware::class], function() use ($router) {
                    //dashboard
                    $router->resource('/', DashboardController::class, ['only' => ['index'], 'names' => [
                        'index'     => 'avalon.admin.panel.dashboard.index',
                    ]]);
                    //Logout
                    $router->get('/logout', ['as' => 'avalon.admin.auth.destroy', 'uses' => AuthController::class.'@destroy']);


                    //User Management
                    $router->resource('/users', UsersController::class, ['names' => [
                        'index'     => 'avalon.admin.panel.users.index',
                        'create'    => 'avalon.admin.panel.users.create',
                        'store'     => 'avalon.admin.panel.users.store',
                        'update'    => 'avalon.admin.panel.users.update',
                        'edit'      => 'avalon.admin.panel.users.edit',
                        'destroy'   => 'avalon.admin.panel.users.destroy',
                    ]]);

                    //Parameter Management
                    $router->resource('/parameters', ParametersController::class, ['names' => [
                        'index'     => 'avalon.admin.panel.parameters.index',
                        'create'    => 'avalon.admin.panel.parameters.create',
                        'store'     => 'avalon.admin.panel.parameters.store',
                        'update'    => 'avalon.admin.panel.parameters.update',
                        'edit'      => 'avalon.admin.panel.parameters.edit',
                        'destroy'   => 'avalon.admin.panel.parameters.destroy',
                    ]]);

                    //Category Management
                    $router->resource('/categories', CategoriesController::class, ['names' => [
                        'index'     => 'avalon.admin.panel.categories.index',
                        'create'    => 'avalon.admin.panel.categories.create',
                        'store'     => 'avalon.admin.panel.categories.store',
                        'update'    => 'avalon.admin.panel.categories.update',
                        'edit'      => 'avalon.admin.panel.categories.edit',
                        'destroy'   => 'avalon.admin.panel.categories.destroy',
                    ]]);


                });
                $router->resource('/', AuthController::class, [
                    'only' => [
                        'index',
                        'store',
                        'destroy'
                    ],
                    'names' => [
                        'index' => 'avalon.admin.auth.index',
                        'store' => 'avalon.admin.auth.store',
                    ]
                ]);
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
        //Registering my services on laravel's container
        $this->app->singleton('AvalonAdmin.ParameterService', ParameterService::class);
        $this->app->singleton('AvalonAdmin.CategoryService', CategoryService::class);


        //Registering my Facades. (I'll not make user register manually so usefull facades.)
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Avalon\Parameter', \Andersonef\AvalonAdmin\Facades\Parameter::class);
        $loader->alias('Avalon\Category', \Andersonef\AvalonAdmin\Facades\Category::class);



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

        //Injecting dependencies on services:
        $this->app->when(ParameterService::class)->needs(Model::class)->give(Parameter::class);
        $this->app->when(CategoryService::class)->needs(Model::class)->give(Category::class);
    }
}