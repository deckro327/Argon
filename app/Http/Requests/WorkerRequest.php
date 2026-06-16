<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkerRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('students')->ignore($this->worker)],
            'surname' => ['required', 'string', 'max:100', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'age' => ['required', 'integer'],
            'area_id' => ['required', 'exists:areas,id'],
        ];
    }
}

