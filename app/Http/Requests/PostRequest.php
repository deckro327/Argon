<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        // $postId = $this->route('post');

        return [
            'title' => ['required', 'string', 'min:3', 'max:255', Rule::unique('posts')->ignore($this->post)],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
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
            'title.required' => 'El título es requerido',
            'title.string' => 'El título debe ser un texto',
            'title.min' => 'El título no puede tener menos de 3 caracteres',
            'title.max' => 'El título no puede tener más de 255 caracteres',
            'title.unique' => 'El título ya está en uso',
            'slug.string' => 'El slug debe ser un texto',
            'slug.min' => 'El slug no puede tener menos de 3 caracteres',
            'slug.max' => 'El slug no puede tener más de 255 caracteres',
            'slug.unique' => 'El slug ya está en uso',
            'content.required' => 'El contenido es requerido',
            'content.string' => 'El contenido debe ser un texto',
            'category_id.required' => 'La categoría es requerida',
            'category_id.exists' => 'La categoría seleccionada no es válida',
        ];
    }
}
