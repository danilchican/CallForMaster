<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Request;

class UpdateMainSettingsRequest extends Request
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
            'user.name' => 'min:2|max:30|required',
            'company.name' => 'min:2|max:30|required',
            'company.unp_number' => 'required|size:9|regex:/[0-9]{9}/',
            'company.description' => 'required|min:3|max:300'
        ];
    }
}
