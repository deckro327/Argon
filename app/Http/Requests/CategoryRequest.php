<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:30', Rule::unique('categories')->ignore($this->category)],
            'slug' => ['string', 'min:3', 'max:30', 'unique:categories,slug,except,id'],
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
            'name.string' => 'El nombre debe ser un texto',
            'name.min' => 'El nombre no puede tener menos de 3 caracteres',
            'name.max' => 'El nombre no puede tener más de 30 caracteres',
            'name.unique' => 'El nombre ya está en uso',
            'slug.string' => 'El slug debe ser un texto',
            'slug.min' => 'El slug no puede tener menos de 3 caracteres',
            'slug.max' => 'El slug no puede tener más de 30 caracteres',
            'slug.unique' => 'El slug ya está en uso',
        ];
    }
}
