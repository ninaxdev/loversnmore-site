<?php
/**
* WaitlistSignupRequest.php - Request file
*
* This file is part of the Waitlist component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Waitlist\Requests;

use App\Yantrana\Base\BaseRequest;

class WaitlistSignupRequest extends BaseRequest
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
     * Get the validation rules that apply to the waitlist signup request.
     *
     * The landing page form sends: first_name, email, city.
     * We accept both first_name (from form) and full_name (legacy) for compatibility.
     *
     * @return array
     *-----------------------------------------------------------------------*/
    public function rules()
    {
        // If first_name is submitted (from the landing form), require it.
        // full_name stays optional so any legacy caller / import script still works.
        return [
            'first_name' => 'required_without:full_name|string|min:1|max:100',
            'full_name'  => 'nullable|string|max:100',
            'email'      => 'required|email|max:255',
            'city'       => 'required|string|min:1|max:100',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     *-----------------------------------------------------------------------*/
    public function messages()
    {
        return [
            'first_name.required_without' => __tr('First name is required'),
            'first_name.min'              => __tr('First name is required'),
            'first_name.max'              => __tr('First name must not exceed 100 characters'),
            'full_name.max'               => __tr('Name must not exceed 100 characters'),
            'email.required'              => __tr('Email is required'),
            'email.email'                 => __tr('Please enter a valid email address'),
            'email.max'                   => __tr('Email must not exceed 255 characters'),
            'city.required'               => __tr('City is required'),
            'city.min'                    => __tr('City is required'),
            'city.max'                    => __tr('City must not exceed 100 characters'),
        ];
    }
}
