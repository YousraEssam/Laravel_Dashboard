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
            'start_date' => 'required|date_format:d-m-Y|after_or_equal:'.Carbon::today()->toDateString(),
            'end_date' => 'required|date_format:d-m-Y|after_or_equal:start_date',
            'visitors' => 'required|exists:visitors,id',
            'images' => 'image|mimes:png,jpg|max:1024',
        ];
    }
}
