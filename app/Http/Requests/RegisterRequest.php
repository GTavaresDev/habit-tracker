<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5', 'max:20', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome é no maximo de 255 caracteres.',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.unique' => 'Email inválido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 5 caracteres.',
            'password.max' => 'A senha deve ter no maximo 20 caracteres.',
            'password.confirmed' => 'As senhas não conhecidem.',
        ];
    }
}
