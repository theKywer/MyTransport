<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

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
            'transport_id'  => 'required|integer|exists:transport,id',
            'event_id'      => 'required|integer|exists:event,id',
            'detail_id'     => 'required|integer|exists:event_detail,id',
            
            'name'          => 'nullable|string|max:255',
            'article'       => 'nullable|string|max:255',
            'count'         => 'required|integer|min:1',
            'price'         => 'nullable|numeric|min:0',
            'description'   => 'nullable|string',
        ];
    }
}
