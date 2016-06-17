<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 12:30
 */

namespace Andersonef\AvalonAdmin\Services\Core;


use Andersonef\AvalonAdmin\Exceptions\AvalonAdminPanelException;
use Andersonef\AvalonAdmin\Models\User;
use Illuminate\Contracts\Auth\Guard;

class UserService
{
    protected $guard;
    protected $user;

    public function __construct(User $user)
    {
        $this->guard = auth()->guard('avalon-admin');
        $this->user  = $user;
    }


    public function authenticate(array $credentials)
    {
        if(empty($credentials['userEmail']) || empty($credentials['userPassword']))
            throw new AvalonAdminPanelException(trans('AvalonAdmin::Module.services.core.user.invalidCredentials'));

        $credentials['password'] = $credentials['userPassword'];
        unset($credentials['userPassword']);
        if(!$this->guard->attempt($credentials))
            throw new AvalonAdminPanelException(trans('AvalonAdmin::Module.services.core.user.authError'));

        $this->user  = $this->user->where('userEmail', $credentials['userEmail'])->first();
        $this->guard->setUser($this->user);
    }

    public function getLoggedUser()
    {
        return $this->guard->user();
    }
}