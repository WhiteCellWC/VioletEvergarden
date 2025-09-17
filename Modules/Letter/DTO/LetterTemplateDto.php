<?php

namespace Modules\Letter\DTO;

use App\Enums\SendType;
use App\Models\LetterTemplate;
use Illuminate\Http\Request;

class LetterTemplateDto
{
    public function __construct(
        //Letter Template
        public ?int $id,
        public string $name,
        public string $description,
        public ?string $sendType,
        public int $paperTypeId,
        public ?int $fragranceTypeId,
        public int $envelopeTypeId,
        public int $waxSealTypeId,
        public ?bool $status,

        //Letter Type
        public ?array $letterTypeIds
    ) {}

    public function toArray()
    {
        return [
            LetterTemplate::id => $this->id,
            LetterTemplate::name => $this->name,
            LetterTemplate::description => $this->description,
            LetterTemplate::sendType => $this->sendType,
            LetterTemplate::paperTypeId => $this->paperTypeId,
            LetterTemplate::fragranceTypeId => $this->fragranceTypeId,
            LetterTemplate::envelopeTypeId => $this->envelopeTypeId,
            LetterTemplate::waxSealTypeId => $this->waxSealTypeId,
            LetterTemplate::status => $this->status
        ];
    }

    public static function fromRequest(Request $request, $id = null)
    {
        return new self(
            //Letter Template
            $id,
            $request->name,
            $request->description,
            SendType::from($request->send_type)->value,
            $request->paper_type_id,
            $request->fragrance_type_id,
            $request->envelope_type_id,
            $request->wax_seal_type_id,
            $request->status ?? true,

            // Letter Type
            $request->letter_type_ids
        );
    }
}
