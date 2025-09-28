<?php

namespace Modules\Location\Http\Request\Backend\Country;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
            'iso_code' => 'required|unique:' . Country::table . ',' . Country::isoCode . ',' . $this->route('country'),
            'phone_code' => 'required'
        ];
    }
}
