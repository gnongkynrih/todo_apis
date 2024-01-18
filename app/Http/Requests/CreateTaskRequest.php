<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'desc' => 'required|string|max:100|min:5',
        ];
    }
    public function messages(): array{
        return [
            'desc.required' => 'Description is required',
            'desc.max' => 'Description must be less than 100 characters',
            'desc.min' => 'Description must be at least 5 characters',
        ];
    }
}
