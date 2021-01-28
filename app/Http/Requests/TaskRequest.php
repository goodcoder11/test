<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'user_name' => 'required|string|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|min:2|max:200',
            'text' => 'required|string|min:2|max:1000',
        ];
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'user_name.regex' => 'The name filed must contain only strings [A-Z, a-z]'
        ]);
    }
}
