<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandybarRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255', 'min:3'],
            'amount' => ['sometimes', 'integer', 'min:0'],
            'candybarTreshhold' => ['sometimes', 'integer', 'min:0'],
            'isAvailable' => ['sometimes', 'boolean'],
        ];
    }
}
