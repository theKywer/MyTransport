<?php

namespace App\Http\Requests\Transport;

use App\Enum\TransportType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'id' => 'required|integer|exists:transport,id',
            'type_id' => 'required|integer|in:' . implode(',', TransportType::values()),
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('transport', 'name')
                    ->ignore($this->id)
                    ->where('user_id', Auth::id()),
            ],
            'vin' => [
                'required',
                'string',
                'max:255',
                Rule::unique('transport', 'vin')
                    ->ignore($this->id)
                    ->where('user_id', Auth::id()),
            ],
            'year' => 'required|integer',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'mileage' => 'required|integer',
            'average_consumption' => 'nullable|numeric'
        ];
    }
}
