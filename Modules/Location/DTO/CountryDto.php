<?php

namespace Modules\Location\DTO;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $isoCode,
        public string $phoneCode
    ) {}

    public function toArray()
    {
        return [
            Country::id => $this->id,
            Country::name => $this->name,
            Country::isoCode => $this->isoCode,
            Country::phoneCode => $this->phoneCode
        ];
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->id,
            $request->name,
            $request->isoCode,
            $request->phoneCode
        );
    }
}
