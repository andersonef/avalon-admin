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
    protected $fillable = ['roleId', 'userPicture', 'userName','userEmail','userPassword','remember_token'];
    protected $guard = 'avalon-admin';

    public function getAuthPassword()
    {
        return $this->userPassword;
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }

    public function getUserPictureAttribute($value)
    {
        if(!$value) return asset('/avalon-admin-assets/dist/img/avatar5.png');
        return "data:image/jpeg;base64,".base64_encode($value);
    }


}