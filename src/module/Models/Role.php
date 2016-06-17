<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:08
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'avalonadmin_roles';
    protected $fillable = ['id','roleName','roleDescription'];
    public $incrementing = false;

    public function getRoleNameAttribute($value)
    {
        return trans($value);
    }

    public function getRoleDescriptionAttribute($value)
    {
        return trans($value);
    }
}