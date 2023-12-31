<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateDishRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating' => 'required|numeric|min:1|max:5'
        ];
    }
}