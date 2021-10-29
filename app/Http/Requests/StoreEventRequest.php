<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class StoreEventRequest extends FormRequest
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
        $rules = [
            "capacity" => 'required|numeric|gt:1',
            "date" => 'required|date',
            "categoryId" => 'required|numeric'
        ];

        foreach (Config::get('constants.default_languages') as $language){
            $rules["name_$language"] = 'required|string';
        }

        return $rules;
    }
}
