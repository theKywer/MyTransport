<?php

namespace App\Http\Requests;

use App\Enum\TransportType;
use Illuminate\Foundation\Http\FormRequest;

class TransportUpdateRequest extends FormRequest
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
            'type_id' => 'integer|in:' . implode(',', TransportType::values()),
            'name' => 'string|max:255|unique:transport',
            'vin' => 'string|max:255|unique:transport',
            'year' => 'integer',
            'brand' => 'string|max:255',
            'model' => 'string|max:255',
        ];
    }
}
