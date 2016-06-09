<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:55
 */

namespace Andersonef\AvalonAdmin\Facades;


use Illuminate\Support\Facades\Facade;

class Website extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Client.AvalonWebsiteService';
    }

}