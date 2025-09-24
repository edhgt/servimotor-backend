<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoStoreRequest extends FormRequest
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
            'vin' => 'nullable',
            'placa' => 'required',
            'anio' => 'required',
            'marca_id' => 'required',
            'modelo_id' => 'required',
            'color_id' => 'required',
            'tipo_vehiculo_id' => 'required',
            'tipo_motor_id' => 'required',
            'tipo_transmision_id' => 'required',
            'cliente_id' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'anio' => 'año',
            'tipo_vehiculo_id' => 'tipo vehiculo',
            'tipo_motor_id' => 'tipo motor',
            'tipo_transmision_id' => 'tipo transmision',
        ];
    }
}
