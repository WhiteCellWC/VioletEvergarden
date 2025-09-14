<?php

namespace Modules\LetterComponent\DTO;

use App\Models\PaperType;
use Illuminate\Http\Request;

class PaperTypeDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public array $images,
        public ?array $deleteImages,
        public int $stock,
        public string $gradient,
        public float $pricePerPage,
        public string $description,
        public ?bool $isPremium,
        public ?float $discount,
        public ?bool $status
    ) {}

    public function toArray()
    {
        return [
            PaperType::id => $this->id,
            PaperType::name => $this->name,
            PaperType::stock => $this->stock,
            PaperType::gradient => $this->gradient,
            PaperType::pricePerPage => $this->pricePerPage,
            PaperType::description => $this->description,
            PaperType::isPremium => $this->isPremium,
            PaperType::discount => $this->discount,
            PaperType::status => $this->status
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
            $request->gradient,
            $request->price_per_page,
            $request->description,
            $request->is_premium ?? false,
            $request->discount,
            $request->status ?? true
        );
    }
}
