<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'first_name'                => 'bail|required|string',
            'last_name'                 => 'bail|required|string',
            'email'                     => 'bail|required|email|unique:users',
            'password'                  => 'bail|required|string',
            'c_password'                => 'bail|required|same:password',
            'profile.title'             => 'bail|required|string|max:255',
            'profile.company_name'      => 'bail|required|string|max:255',
            'profile.company_address'   => 'bail|required|string|max:255',
            'profile.contact_email'     => 'bail|required|string|email|max:255',
            'profile.city'              => 'bail|required|string|max:255',
            'profile.state'             => 'bail|required|string|max:255',
            'profile.country'           => 'bail|required|string|max:255',
            'profile.zip'               => 'bail|required|string|max:255',
            'profile.type'              => 'bail|required|string|max:255',
            'profile.sub_type'          => 'bail|required|string|max:255',
            'profile.industry'          => 'bail|required|string|max:255',
            'profile.size'              => 'bail|required|string|max:255',
            'profile.interest'          => 'bail|required|string|max:255',
            'profile.verification'      => 'bail|required|string|max:255',
        ];
    }
}
