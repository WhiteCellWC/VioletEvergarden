<?php

namespace Modules\Location\DTO;

use App\Models\Country;
use Illuminate\Http\Request;

readonly class SearchCountryDto
{
    public function __construct(
        public ?string $name,
        public ?string $isoCode,
        public ?string $phoneCode
    ) {}

    public function toArray(): array
    {
        return [
            Country::name => $this->name,
            Country::isoCode => $this->isoCode,
            Country::phoneCode => $this->phoneCode
        ];
    }

    public static function fromRequest(Request $request, ?int $id = null): SearchCountryDto
    {
        return new self(
            $request->name,
            $request->iso_code,
            $request->phone_code
        );
    }
}
