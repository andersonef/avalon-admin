<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 16/06/2016
 * Time: 12:40
 */

namespace Andersonef\AvalonAdmin\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AuthRequest extends FormRequest
{


    public function authorize()
    {
        if(app()->runningInConsole()) return false;
        return true;
    }

    public function rules()
    {
        return [
            'userEmail'             => 'required|email',
            'userPassword'          => 'required'
        ];
    }
}