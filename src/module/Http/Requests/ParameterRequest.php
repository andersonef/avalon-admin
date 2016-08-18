<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/08/2016
 * Time: 14:20
 */

namespace Andersonef\AvalonAdmin\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ParameterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'categoryId'        => 'required|exists:avalonadmin_categories,id',
            'id'                => 'required|min:2|alpha_num',
            'parameterValue'    => 'required'
        ];

        if($this->getMethod() == 'POST'){
            $rules['id'] .= '|unique:avalonadmin_parameters,id';
        }

        return $rules;
    }

}