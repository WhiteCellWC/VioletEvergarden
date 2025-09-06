<?php

namespace Modules\LetterComponent\Action\FragranceType;

use Throwable;
use Illuminate\Http\Request;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;
use Modules\LetterComponent\DTO\SearchFragranceTypeDto;
use Modules\Shared\DTO\QueryOptionsDto;

class SearchFragranceTypeAction
{
    public function __construct(protected FragranceTypeServiceInterface $fragranceTypeService) {}

    public function handle(Request $request, array|string|null $relation = null)
    {
        try {
            $condsIn = SearchFragranceTypeDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            $fragranceTypes = $this->fragranceTypeService->getAll($relation, $condsIn, $request->condsNotIn, $queryOptions);

            return $fragranceTypes;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
