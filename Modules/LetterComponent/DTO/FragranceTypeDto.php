<?php

namespace Modules\LetterComponent\DTO;

use App\Models\FragranceType;
use Illuminate\Http\Request;

class FragranceTypeDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $image,
        public string $description,
        public bool $isPremium,
        public float $price,
        public float $discount,
        public bool $status
    ) {}

    public function toArray()
    {
        return [
            FragranceType::id => $this->id,
            FragranceType::name => $this->name,
            FragranceType::image => $this->image,
            FragranceType::description => $this->description,
            FragranceType::isPremium => $this->isPremium,
            FragranceType::price => $this->price,
            FragranceType::discount => $this->discount,
            FragranceType::status => $this->status
        ];
    }

    public static function fromRequest(Request $request, $id = null)
    {
        return new self(
            $id,
            $request->name,
            $request->image,
            $request->description,
            $request->isPremium,
            $request->price,
            $request->discount,
            $request->status
        );
    }
}
