<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 06/06/2016
 * Time: 12:34
 */

namespace Andersonef\AvalonAdmin\Http\Controllers;


use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('AvalonAdmin::content.auth.index');
    }
}