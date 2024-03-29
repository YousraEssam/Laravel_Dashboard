<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderRequest extends FormRequest
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
            'name' => 'required|min:3|max:150',
            'description' => 'min:3|max:250',
            // 'image' => 'image|mimes:png,jpg|max:1024',
            // 'file' => 'file|mimes:pdf,xls|max:1024',
            // 'video' => 'file|mimes:mp4,mpeg|max:2048',
        ];
    }
}
