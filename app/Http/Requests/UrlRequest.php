<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlRequest extends FormRequest
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        return [
            'name' => 'required|string|min:2|max:20',
            'url' => array('required', 'regex:'.$regex)

        ];
    }

    public function messages()
    {
        return [
        'name.required' => "Vous devez entrer un nom",
        'name.max' => 'Le nom doit comporter un maximum de 20 caractères',
        'name.min' => 'Le nom doit comporter au minimum 2 caractères',
        'url.required' => 'Vous devez entrer une Url',
        'url.regex' => "L'url entrée n'est pas valide"
      ];
    }
}
