<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'login' => 'nullable|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|max:255',
            'firstname' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'phone' => 'nullable|string|unique:users',
            'birthday' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Почта обязательна',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}
