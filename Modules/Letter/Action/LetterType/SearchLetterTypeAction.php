<?php

namespace Modules\Letter\Action\LetterType;

use Throwable;
use Illuminate\Http\Request;
use Modules\Letter\Contract\LetterTypeServiceInterface;
use Modules\Letter\DTO\SearchLetterTypeDto;
use Modules\Shared\DTO\QueryOptionsDto;

class SearchLetterTypeAction
{
    public function __construct(protected LetterTypeServiceInterface $letterTypeService) {}

    public function handle(Request $request, array|string|null $relation = null)
    {
        try {
            $condsIn = SearchLetterTypeDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            $letterTypes = $this->letterTypeService->getAll($relation, $condsIn, $request->condsNotIn, $queryOptions);

            return $letterTypes;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
