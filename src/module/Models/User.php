<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 09/06/2016
 * Time: 13:43
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class User extends \Illuminate\Foundation\Auth\User
{
    protected $table = 'avalonadmin_users';
    protected $fillable = ['roleId', 'userName','userEmail','userPassword','remember_token'];
    protected $guard = 'avalon-admin';

    public function getAuthPassword()
    {
        return $this->userPassword;
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }


}