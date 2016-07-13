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
            'user.name' => 'min:5|max:30',
            'company.name' => 'min:5|max:30',
            'company.unp_number' => 'min:5|max:20',
            'company.description' => 'min:3'
        ];
    }
}
