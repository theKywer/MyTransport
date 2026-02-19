<?php

namespace App\Http\Requests\Event;

use App\Enum\EventType;
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
            'transport_id'                      => 'required|integer|exists:transport,id',
            'type_id'                           => 'required|integer|in:' . implode(',', EventType::values()),
            'mileage'                           => 'required|integer|min:0',
            'work'                              => 'required|integer|min:0',
            'resource'                          => 'required|integer|min:0',
            'total'                             => 'required|integer|min:0',
            'location'                          => 'required|string|max:255',
            'description'                       => 'nullable|string',
            
            'details'                           => 'nullable|array',
            'details.*.name'                    => 'required|string|max:255',
            'details.*.work'                    => 'required|numeric|min:0',
            'details.*.resource'                => 'required|numeric|min:0',
            'details.*.total'                   => 'required|numeric|min:0',
            'details.*.desctiption'             => 'nullable|string',
            
            'details.*.resources'               => 'nullable|array',
            'details.*.resources.*.name'        => 'nullable|string|max:255',
            'details.*.resources.*.article'     => 'nullable|string|max:255',
            'details.*.resources.*.count'       => 'required|integer|min:1',
            'details.*.resources.*.price'       => 'nullable|numeric|min:0',
            'details.*.resources.*.description' => 'nullable|string',
        ];
    }
}
