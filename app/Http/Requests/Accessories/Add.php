<?php

namespace App\Http\Requests\Accessories;

use App\Models\Admin\Accessories\Accessories;
use Illuminate\Foundation\Http\FormRequest;

class Add extends FormRequest
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
            'parent_id' => 'nullable|integer|exists:'.Accessories::class.',id',
            'title' => 'required',
            'ordering' => 'required|integer|between:1,9999',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле "Название категории" не должно быть пустым!',
            'ordering.required' => 'Поле "Порядок сортировки" не должно быть пустым!',
            'ordering.integer' => 'Поле "Порядок сортировки" должно быть числом!',
            'ordering.between' => 'Поле "Порядок сортировки" должно быть в пределах от :min до :max!    ',
            'ordering.max' => 'Поле "Порядок сортировки" должно быть как минимум :max!',
          ];
    }
}
