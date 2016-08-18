<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/08/2016
 * Time: 14:20
 */

namespace Andersonef\AvalonAdmin\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'categoryName'                 => 'required|min:2|alpha_num|unique:avalonadmin_categories,categoryName',
            'categoryDescription'          => 'required'
        ];

        return $rules;
    }

}