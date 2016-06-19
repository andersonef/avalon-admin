<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 12:59
 */

namespace Andersonef\AvalonAdmin\Http\Controllers\Panel;


use Andersonef\AvalonAdmin\Services\Core\UserService;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        return view('AvalonAdmin::content.panel.dashboard.index');
    }

}