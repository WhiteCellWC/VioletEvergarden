<?php

namespace Modules\Location\DTO;

use App\Models\State;
use Illuminate\Http\Request;

class StateDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $countryId
    ) {}

    public function toArray()
    {
        return [
            State::id => $this->id,
            State::name => $this->name,
            State::countryId => $this->countryId
        ];
    }

    public static function fromRequest(Request $request, $id = null)
    {
        return new self(
            $id,
            $request->name,
            $request->countryId
        );
    }
}
