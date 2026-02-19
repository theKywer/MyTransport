<?php

namespace App\Http\Requests\Fuel;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'mileage' => 'required|integer',
            'amount' => 'required|numeric',
            'is_full' => 'required|boolean',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
            'station_id' => 'nullable|integer',
        ];
    }
}
