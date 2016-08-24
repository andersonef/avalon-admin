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
        if(!$this->categoryInternal){
            $this->merge(['categoryInternal' => 0]);
        }
        $id = $this->route()->getParameter('categories');
        $rules = [
            'categoryName'                 => 'required|min:2|unique:avalonadmin_categories,categoryName,'.$id,
            'categoryDescription'          => 'required'
        ];

        return $rules;
    }

}