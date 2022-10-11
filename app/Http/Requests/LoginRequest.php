<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'required|min:2|max:25',
            'password' => 'required|min:8|max:16',
        ];
    }
    public function messages()
    {
        return [
            'login.required' => 'Поле "логин" является обязательным',
            'login.min' => 'Минимальная длина логина 2 символа',
            'login.max' => 'Максимальная длина логина 25 символов',
            'password.required' => 'Поле "пароль" является обязательным',
            'password.min' => 'Минимальная длина пароля 8 символов',
            'password.max' => 'Максимальная длина пароля 25 символов',
        ];
    }
    //    public function attributes()
//    {
//        return [
//            'login'=>'Логин'
//        ];
//    }
}
