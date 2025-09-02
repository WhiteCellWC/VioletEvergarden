<?php

namespace Modules\LetterComponent\Action\FragranceType;

use Throwable;
use Illuminate\Http\Request;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;

class SearchFragranceTypeAction
{
    public function __construct(protected FragranceTypeServiceInterface $fragranceTypeService) {}

    public function handle(Request $request)
    {
        try {
            $fragranceTypes = $this->fragranceTypeService->getAll([], $request->condsIn, $request->condsNotIn, $request->orderBy);

            return $fragranceTypes;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
