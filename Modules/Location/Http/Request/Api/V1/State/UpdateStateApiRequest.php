<?php

namespace Modules\Location\Http\Request\Api\V1\State;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStateApiRequest extends FormRequest
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
            'countryId' => 'required|exists:' . Country::table . ',' . Country::id
        ];
    }
}
