<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Создание записи события. Транзакция создаёт записи в следующие модели:
 * - {@see Transport::mileage}
 * - {@see Event}
 * - {@see Detail}
 * - {@see Resource}
 */
class Get extends FormRequest
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
            'transport_id' => 'required|integer|exists:transport,id',
            'id' => 'nullable|integer|exists:events,id'
        ];
    }
}
