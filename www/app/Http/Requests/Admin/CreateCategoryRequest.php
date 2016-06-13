<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CreateCategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30',
            'slug' => 'required|unique:prso_categories|min:3|max:50',
            'desc' => 'max:100',
            'parent_id' => 'integer:exists:prso_categories,id'
        ];
    }
}
