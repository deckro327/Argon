<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'type' => ['required', 'string', 'min:3', 'max:20'],
            'color' => ['required', 'string', 'min:3', 'max:20'],
            'age' => ['required', 'integer', 'min:1', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre no debe tener más de 30 caracteres',
            'type.required' => 'El tipo es requerido',
            'type.string' => 'El tipo debe ser una cadena de texto',
            'type.min' => 'El tipo debe tener al menos 3 caracteres',
            'type.max' => 'El tipo no debe tener más de 20 caracteres',
            'color.required' => 'El color es requerido',
            'color.string' => 'El color debe ser una cadena de texto',
            'color.min' => 'El color debe tener al menos 3 caracteres',
            'color.max' => 'El color no debe tener más de 20 caracteres',
            'age.required' => 'La edad es requerida',
            'age.integer' => 'La edad debe ser un número entero',
            'age.min' => 'La edad debe ser mayor a 0',
            'age.max' => 'La edad no debe ser mayor a 255',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser una imagen de tipo: jpeg, png, jpg, gif o webp',
            'image.max' => 'El archivo no debe pesar más de 2MB',
        ];
    }
}
