<?php

namespace Modules\LetterComponent\Http\Request\Backend\PaperType;

use App\Models\CoreImage;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaperTypeRequest extends FormRequest
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
            'stock' => 'required|integer|min:0',
            'price_per_page' => 'required|numeric|min:0',
            'description' => 'required',
            'is_premium' => 'nullable|boolean',
            'discount' => 'nullable|min:0|max:100',
            'status' => 'nullable|boolean'
        ];
    }
}
