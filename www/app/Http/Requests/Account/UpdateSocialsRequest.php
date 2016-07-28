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
            'vk_url' => 'min:10|max:100|url',
            'fb_url' => 'min:10|max:100|url',
            'ok_url' => 'min:10|max:100|url',
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
