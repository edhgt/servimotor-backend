<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nit' => 'required',
            'primer_nombre' => 'required',
            'segundo_nombre' => 'nullable',
            'primer_apellido' => 'required',
            'segundo_apellido' => 'nullable',
            'direccion' => 'required',
            'telefono' => 'required',
        ];
    }
}
