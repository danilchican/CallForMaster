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
            'username' => 'min:5|max:30',
            'company_name' => 'min:5|max:30',
            'unp_number' => 'min:5|max:20',
            'description' => 'min:3'
        ];
    }
}
