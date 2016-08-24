<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/06/16
 * Time: 19:32
 */

namespace Andersonef\AvalonAdmin\Http\Controllers\Panel;


use Andersonef\AvalonAdmin\Facades\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $items = User::getLastOnes()->paginate(10);
        return view('AvalonAdmin::content.panel.users.index', ['items' => $items]);
    }
}