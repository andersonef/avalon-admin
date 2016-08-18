<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:14
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'avalonadmin_categories';
    protected $fillable = ['categoryName','categoryDescription', 'categoryInternal'];
}