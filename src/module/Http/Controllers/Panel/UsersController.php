<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/06/16
 * Time: 19:32
 */

namespace Andersonef\AvalonAdmin\Http\Controllers\Panel;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->has('_datatable'))
            return view('AvalonAdmin::content.panel.users.index');
    }
}