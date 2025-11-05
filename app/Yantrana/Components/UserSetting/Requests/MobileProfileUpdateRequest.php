<?php
/**
* MobileProfileUpdateRequest.php - Request file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\UserSetting\Requests;

use App\Yantrana\Base\BaseRequest;

class MobileProfileUpdateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *-----------------------------------------------------------------------*/
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the mobile profile update request.
     *
     * @return array
     *-----------------------------------------------------------------------*/
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:18|max:100',
            'about_me' => 'nullable|string|max:1000',
            'selected_city' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => __tr('Name is required'),
            'first_name.max' => __tr('Name cannot be longer than 255 characters'),
            'age.integer' => __tr('Age must be a number'),
            'age.min' => __tr('Age must be at least 18'),
            'age.max' => __tr('Age cannot be more than 100'),
            'about_me.max' => __tr('About Me cannot be longer than 1000 characters'),
        ];
    }
}
