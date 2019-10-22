<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class EventRequest extends FormRequest
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
            'start_date' => 'required|after_or_equal:'.now()->toDateTimeString(),
            'end_date' => 'required|after_or_equal:start_date',
            'visitors' => 'required|exists:visitors,id',
            'images' => 'image|mimes:png,jpg|max:1024',
        ];
    }
}
