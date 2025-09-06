<?php

namespace Modules\LetterComponent\Http\Request\Api\V1\EnvelopeType;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnvelopeTypeApiRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required|image',
            'stock' => 'required|integer|min:0',
            'price' => 'required|decimal:8,2',
            'description' => 'required',
            'is_premium' => 'nullable|boolean',
            'discount' => 'nullable|min:1|max:100',
            'status' => 'nullable|boolean'
        ];
    }
}
