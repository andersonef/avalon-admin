<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 13:06
 */

namespace Andersonef\AvalonAdmin\Http\Middlewares;


use Andersonef\AvalonAdmin\Services\Core\UserService;
use Closure;

class AuthMiddleware
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if(!$user = $this->userService->getLoggedUser()){
            return redirect(route('avalon.admin.auth.index'));
        }
        return $next($request);
    }
}