<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkUpdateRequest extends FormRequest
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
            'description' => 'required|string|max:255',
            'link_path' => 'required|string|max:255',
            'is_create_link' => 'nullable|boolean',  // Assuming it holds a boolean value (true/false)
            'file_name' => 'required_if:is_create_link,on'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            '*.required' => 'Le champ est obligatoire.',
            '*.required_if' => 'Le champ est obligatoire.',
            '*.string' => 'Le champ description doit être une chaîne de caractères.',
            '*.max' => 'Le champ description ne peut pas dépasser 255 caractères.',
            'is_create_link.boolean' => 'Le champ is_create_link doit être vrai ou faux.',
        ];
    }
}
