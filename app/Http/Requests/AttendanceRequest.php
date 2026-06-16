<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'worker_id' => ['required', 'integer', 'exists:workers,id'],
            'status' => ['required', 'string', 'in:presente,justificado,ausente'],
            'punctuality' => [$this->input('status') === 'presente' ? 'required' : 'nullable', 'date_format:H:i'],
            'departure' => [$this->input('status') === 'presente' ? 'required' : 'nullable', 'date_format:H:i'],
        ];
    }
}
