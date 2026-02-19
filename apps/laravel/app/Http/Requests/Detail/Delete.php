<?php

namespace App\Http\Requests\Detail;

use Illuminate\Foundation\Http\FormRequest;

class Delete extends FormRequest
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
            'event_id'                          => 'required|integer|exists:event,id',
            
            'name'                              => 'required|string|max:255',
            'work'                              => 'required|numeric|min:0',
            'resource'                          => 'required|numeric|min:0',
            'total'                             => 'required|numeric|min:0',
            'desctiption'                       => 'nullable|string',
            
            'resources'                         => 'nullable|array',
            'resources.*.name'                  => 'nullable|string|max:255',
            'resources.*.article'               => 'nullable|string|max:255',
            'resources.*.count'                 => 'required|integer|min:1',
            'resources.*.price'                 => 'nullable|numeric|min:0',
            'resources.*.description'           => 'nullable|string',
        ];
    }
}
