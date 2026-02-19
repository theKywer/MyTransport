<?php

namespace App\Http\Requests;

use App\Enum\TransportType;
use Illuminate\Foundation\Http\FormRequest;

class TransportCreateRequest extends FormRequest
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
            'type_id' => 'required|integer|in:' . implode(',', TransportType::values()),
            'name' => 'required|string|max:255|unique:transport',
            'vin' => 'required|string|max:255|unique:transport',
            'year' => 'required|integer',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
        ];
    }
}
