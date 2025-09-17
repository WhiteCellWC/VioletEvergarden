<?php

namespace Modules\Letter\DTO;

use App\Models\LetterType;
use Illuminate\Http\Request;

class SearchLetterTypeDto
{
    public function __construct(
        public ?string $name,
        public ?bool $status
    ) {}

    public function toArray()
    {
        return [
            LetterType::name => $this->name,
            LetterType::status => $this->status
        ];
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->name,
            $request->status
        );
    }
}
