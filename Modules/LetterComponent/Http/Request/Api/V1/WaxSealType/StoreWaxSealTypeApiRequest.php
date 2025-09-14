<?php

namespace Modules\LetterComponent\Http\Request\Api\V1\WaxSealType;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreWaxSealTypeApiRequest extends FormRequest
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
            'user_id' => 'nullable|exists:' . User::table . ',' . User::id,
            'name' => 'required',
            'images' => 'required|array',
            'images.*' => 'image',
            'color' => 'required|string',
            'is_custom' => 'nullable|boolean',
            'price' => 'required|numeric|min:0',
            'is_premium' => 'nullable|boolean',
            'discount' => 'nullable|min:0|max:100',
            'status' => 'nullable|boolean'
        ];
    }
}
