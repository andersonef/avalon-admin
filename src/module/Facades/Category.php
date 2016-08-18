<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:55
 */

namespace Andersonef\AvalonAdmin\Facades;


use Illuminate\Support\Facades\Facade;

class Category extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AvalonAdmin.CategoryService';
    }

}