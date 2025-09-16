<?php

namespace Modules\Letter\Http\Request\Api\LetterTemplate;

use App\Enums\SendType;
use App\Models\EnvelopeType;
use App\Models\FragranceType;
use App\Models\PaperType;
use App\Models\WaxSealType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreLetterTemplateApiRequest extends FormRequest
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
            'description' => 'required',
            'send_type' => ['required', new Enum(SendType::class)],
            'paper_type_id' => 'required|exists:' . PaperType::table . ',' . PaperType::id,
            'fragrance_type_id' => 'nullable|exists:' . FragranceType::table . ',' . FragranceType::id,
            'envelope_type_id' => 'required|exists:' . EnvelopeType::table . ',' . EnvelopeType::id,
            'wax_seal_type_id' => 'required|exists:' . WaxSealType::table . ',' . WaxSealType::id,
            'status' => 'nullable|boolean'
        ];
    }
}
