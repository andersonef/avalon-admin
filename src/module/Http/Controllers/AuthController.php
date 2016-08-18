<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:34
 */

namespace Andersonef\AvalonAdmin\Http\Controllers;


use Andersonef\AvalonAdmin\Exceptions\AvalonAdminPanelException;
use Andersonef\AvalonAdmin\Http\Requests\AuthRequest;
use Andersonef\AvalonAdmin\Services\Core\UserService;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        return view('AvalonAdmin::content.auth.index');
    }


    public function store(AuthRequest $request)
    {
        try{
            $this->userService->authenticate($request->only(['userEmail', 'userPassword']));
            return redirect(route('avalon.admin.panel.dashboard.index'));
        } catch (AvalonAdminPanelException $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try{
            $this->userService->logout();
            return redirect()->route('avalon.admin.auth.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}