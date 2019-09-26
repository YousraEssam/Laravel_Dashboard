<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffMemberRequest extends FormRequest
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
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'email' => 'required|string|email',
            'phone' => 'required|string|numeric',
            'gender' => 'required|string',
            'image' => 'image|mimes:png,jpg|max:2048',
            'isActive' => 'required',
            'job_id' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'roles' => 'required',
        ];
    }
}
