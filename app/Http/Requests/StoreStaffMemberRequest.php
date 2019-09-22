<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffMemberRequest extends FormRequest
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
            'email' => 'required|string|email|unique:staff_members',
            'phone' => 'required|string|numeric|unique:staff_members',
            'gender' => 'required|string',
            'image' => 'image|mimes:png,jpg|max:2048',
            'isActive' => 'required',
            'job_id' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'role_id' => 'required',
        ];
    }
}
