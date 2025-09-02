<?php

namespace Modules\Location\DTO;

use App\Models\State;
use Illuminate\Http\Request;

class SearchStateDto
{
    public function __construct(
        public ?string $name,
        public ?string $countryId
    ) {}

    public function toArray()
    {
        return [
            State::name => $this->name,
            State::countryId => $this->countryId
        ];
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->name,
            $request->country_id
        );
    }
}
