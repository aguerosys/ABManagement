<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required'],
            'code' => ['nullable'],
            'amount' => ['required'],
            'category_id' => ['required'],
        
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es requerido',
            'code.required' => 'El campo codigo es requerido',
            'amount.required' => 'El campo cantidad es requerido',
            'category_id.required' => 'El campo categoria es requerido',
        ];
    }
}
