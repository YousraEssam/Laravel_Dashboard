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
            'email' => 'required|string|email|unique:users,id,'.$this->checkIdExists(),
            'phone' => 'required|regex:/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[0-9]+$/|unique:users,id,'.$this->checkIdExists(),
            'gender' => 'required|string',
            'image' => 'image|mimes:png,jpg|max:2048',
            'job_id' => 'required|exists:jobs,id',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function checkIdExists()
    {
        if($this->id) {
            return $this->id;
        } else {
            return false;
        }
    }
}