<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:57
 */

namespace Andersonef\AvalonAdmin\Services;


use Andersonef\AvalonAdmin\Abstracts\ServiceAbstract;
use Andersonef\AvalonAdmin\Models\Parameter;

class CategoryService extends ServiceAbstract
{

    public function havingParameters()
    {
        return $this->model->newQuery()->whereHas('Parameters', function($q){ });
    }


    public function havingContent()
    {
        return $this->model->newQuery()->whereHas('Contents', function($q){});
    }
}