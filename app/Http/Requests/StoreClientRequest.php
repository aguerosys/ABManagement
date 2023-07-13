<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'lastname' => ['required'],
            'firstname' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'address' => ['required']
        
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'El campo apellido es requerido',
            'firstname.required' => 'El campo nombre es requerido',
            'email.required' => 'El campo email es requerido',
            'phone.required' => 'El campo telefono es requerido',
            'address.required' => 'El campo direccion es requerido'
        ];
    }
}
