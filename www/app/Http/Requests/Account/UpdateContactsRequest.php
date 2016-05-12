<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Request;

class UpdateContactsRequest extends Request
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
            'address' => 'min:3|max:80',
            'website_url' => 'min:3|max:50',
            'email' => 'email',
            'skype' => 'min:3|max:20',
            'viber' => 'min:7|max:20',
            'icq' => 'min:3|max:20'
        ];
    }
}
