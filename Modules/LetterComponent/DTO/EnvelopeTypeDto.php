<?php

namespace Modules\LetterComponent\DTO;

use App\Models\EnvelopeType;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class EnvelopeTypeDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public array $images,
        public ?array $deleteImages,
        public int $stock,
        public float $price,
        public string $description,
        public ?bool $isPremium,
        public ?float $discount,
        public ?bool $status
    ) {}

    public function toArray()
    {
        return [
            EnvelopeType::id => $this->id,
            EnvelopeType::name => $this->name,
            EnvelopeType::stock => $this->stock,
            EnvelopeType::price => $this->price,
            EnvelopeType::description => $this->description,
            EnvelopeType::isPremium => $this->isPremium,
            EnvelopeType::discount => $this->discount,
            EnvelopeType::status => $this->status
        ];
    }

    public static function fromRequest(Request $request, $id = null)
    {
        return new self(
            $id,
            $request->name,
            $request->images ?? [],
            $request->delete_images,
            $request->stock,
            $request->price,
            $request->description,
            $request->is_premium ?? false,
            $request->discount,
            $request->status ?? true
        );
    }
}
