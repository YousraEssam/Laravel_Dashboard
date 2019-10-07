<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'main_title' => 'required|min:3|max:150',
            'secondary_title' => 'min:3|max:150',
            'type' => 'required',
            // 'author_id' => 'required|exists:staff_members,id,'.$this->checkIdExists(),
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
