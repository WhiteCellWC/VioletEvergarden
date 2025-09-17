<?php

namespace Modules\Letter\DTO;

use App\Models\LetterType;
use Illuminate\Http\Request;

class LetterTypeDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?bool $status
    ) {}

    public function toArray()
    {
        return [
            LetterType::id => $this->id,
            LetterType::name => $this->name,
            LetterType::status => $this->status
        ];
    }

    public static function fromRequest(Request $request, $id = null)
    {
        return new self(
            $id,
            $request->name,
            $request->status ?? true
        );
    }
}
