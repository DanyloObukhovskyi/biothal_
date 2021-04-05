<?php

namespace App\Http\Requests\Products\Sales;

use Illuminate\Foundation\Http\FormRequest;

class Clear extends FormRequest
{

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
            'productsId' => 'required|array',
            'productsId.*' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'productsId.required' => 'Выберите товар',
            'productsId.array' => 'Попытка изменить внутренние файлы, попробуйте перезагрузить страницу',
            'productsId.*.integer' => 'Id должен быть натуральным числом',
        ];
    }
}
