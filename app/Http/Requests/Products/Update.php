<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'price' => 'required',
            'quantity' => 'required',
            'minimum' => 'required',
            'sort_order' => 'required',
            'product_description.*.description' => 'max:10000',
            'product_description.*.name' => 'max:255|required',
            'product_description.*.meta_description' => 'max:299',
            'product_description.*.meta_keywords' => 'max:250',
            'product_description.*.meta_title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_description.*.meta_description.max' => 'Максимальная длинна мета тега "description", не может привышать 299 символов!',
            'product_description.*.meta_keywords.max' => 'Максимальная длинна мета тегов "keyword", не может привышать 250 символов!',
            'product_description.*.description.max' => 'Максимальная длинна "описания", не может привышать 10000 символов!',
            'product_description.*.name.required' => 'Поле "Название" - обязательное!',
        ];
    }
}
