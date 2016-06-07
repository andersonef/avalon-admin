<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:32
 */

namespace Andersonef\AvalonAdmin\Providers;


use Andersonef\AvalonAdmin\Services\WebsiteService;
use Illuminate\Support\ServiceProvider;

class AvalonAdminProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('avalonWebsite', WebsiteService::class);
    }
}