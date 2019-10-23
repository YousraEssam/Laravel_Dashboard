<?php

namespace App\Http\Requests;

use App\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'type' => 'required|'.Rule::in(array_keys(News::NEWS_TYPE)),
            'author_id' => 'required|exists:staff_members,id',
            'images' => 'image|mimes:png,jpg|max:1024',
            'files' => 'file|mimes:pdf,xls|max:1024',
        ];
    }
}
