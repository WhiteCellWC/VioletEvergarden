<?php

namespace Modules\LetterComponent\DTO;

use App\Models\PaperType;
use Illuminate\Http\Request;

class SearchPaperTypeDto
{
    public function __construct(
        public ?string $name,
        public ?int $stock,
        public ?float $pricePerPage,
        public ?string $description,
        public ?bool $isPremium,
        public ?float $discount,
        public ?bool $status
    ) {}

    public function toArray()
    {
        return [
            PaperType::name => $this->name,
            PaperType::stock => $this->stock,
            PaperType::pricePerPage => $this->pricePerPage,
            PaperType::description => $this->description,
            PaperType::isPremium => $this->isPremium,
            PaperType::discount => $this->discount,
            PaperType::status => $this->status
        ];
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->name,
            $request->stock,
            $request->price_per_page,
            $request->description,
            $request->is_premium,
            $request->discount,
            $request->status
        );
    }
}
