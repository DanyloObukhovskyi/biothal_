<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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

    public function messages()
    {
        return [
            'name.required' => 'Вы не заполнили имя',
            'surname.max' => 'Вы ввели максимальное количество символов',
            'email.required' => 'Вы не ввели електронную почту',
            'email.max' => 'Вы превысили лимит символов для електронной почты',
            'email.unique' => 'Ваша почта не корректна, введите другую',
            'phone_number.required' => 'Вы не ввели телефоный номер',
            'phone_number.max' => 'Вы превысили лимит символов для телефонного номера',
            'password.required' => 'Вы не ввели пароль',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|between:2,100',
            'surname' => 'max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone_number' => 'required|max:20|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ];
    }
}
