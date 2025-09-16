<?php

namespace Modules\LetterComponent\DTO;

use App\Models\EnvelopeType;
use Illuminate\Http\Request;

class SearchEnvelopeTypeDto
{
    public function __construct(
        public ?string $name,
        public ?int $stock,
        public ?float $price,
        public ?string $description,
        public ?bool $isPremium,
        public ?float $discount,
        public ?bool $status
    ) {}

    public function toArray()
    {
        return [
            EnvelopeType::name => $this->name,
            EnvelopeType::stock => $this->stock,
            EnvelopeType::price => $this->price,
            EnvelopeType::description => $this->description,
            EnvelopeType::isPremium => $this->isPremium,
            EnvelopeType::discount => $this->discount,
            EnvelopeType::status => $this->status
        ];
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->name,
            $request->stock,
            $request->price,
            $request->description,
            $request->is_premium,
            $request->discount,
            $request->status
        );
    }
}
