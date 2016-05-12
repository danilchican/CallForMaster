<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Request;

class UpdateSocialsRequest extends Request
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
            'vk_url' => 'min:10|max:50',
            'fb_url' => 'min:10|max:50',
            'ok_url' => 'min:10|max:50',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
