<?php

namespace Modules\Letter\Http\Request\Api\LetterType;

use App\Models\LetterType;
use Illuminate\Foundation\Http\FormRequest;

class StoreLetterTypeApiRequest extends FormRequest
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
            'name' => 'required|unique:' . LetterType::table . ',' . LetterType::name,
            'status' => 'nullable|boolean'
        ];
    }
}
