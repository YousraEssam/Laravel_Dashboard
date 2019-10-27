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
            'cover_url' => 'required',
            'address_address' => 'string',
            // 'address_latitude' => ['regex:/^[-]?(([1-8]?[0-9])(\.(\d{1,16})?)|(90(\.0+)?))$/'],
            // 'address_longitude' => ['regex:/^[-]?(([1]?[0-7]?[0-9])(\.(\d{1,16})?)|(180(\.0+)?))$/'],
        ];
    }
}
