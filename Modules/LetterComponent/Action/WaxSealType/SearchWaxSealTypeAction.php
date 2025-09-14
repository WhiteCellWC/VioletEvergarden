<?php

namespace Modules\LetterComponent\Action\WaxSealType;

use Throwable;
use Illuminate\Http\Request;
use Modules\LetterComponent\Contract\WaxSealTypeServiceInterface;
use Modules\LetterComponent\DTO\SearchWaxSealTypeDto;
use Modules\Shared\DTO\QueryOptionsDto;

class SearchWaxSealTypeAction
{
    public function __construct(protected WaxSealTypeServiceInterface $waxSealTypeService) {}

    public function handle(Request $request, array|string|null $relation = null)
    {
        try {
            $condsIn = SearchWaxSealTypeDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            $waxSealTypes = $this->waxSealTypeService->getAll($relation, $condsIn, $request->condsNotIn, $queryOptions);

            return $waxSealTypes;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
