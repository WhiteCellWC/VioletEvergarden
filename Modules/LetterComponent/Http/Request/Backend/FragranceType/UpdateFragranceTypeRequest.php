<?php

namespace Modules\LetterComponent\Http\Request\Backend\FragranceType;

use App\Models\CoreImage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFragranceTypeRequest extends FormRequest
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
            'images' => 'nullable|array',
            'images.*' => 'image',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:' . CoreImage::table . ',' . CoreImage::id,
            'description' => 'required',
            'is_premium' => 'nullable|boolean',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|min:1|max:100',
            'status' => 'nullable|boolean'
        ];
    }
}
