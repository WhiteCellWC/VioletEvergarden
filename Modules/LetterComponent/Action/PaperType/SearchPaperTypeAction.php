<?php

namespace Modules\LetterComponent\Action\PaperType;

use Throwable;
use Illuminate\Http\Request;
use Modules\LetterComponent\Contract\PaperTypeServiceInterface;
use Modules\LetterComponent\DTO\SearchPaperTypeDto;
use Modules\Shared\DTO\QueryOptionsDto;

class SearchPaperTypeAction
{
    public function __construct(protected PaperTypeServiceInterface $paperTypeService) {}

    public function handle(Request $request, array|string|null $relation = null)
    {
        try {
            $condsIn = SearchPaperTypeDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            $paperTypes = $this->paperTypeService->getAll($relation, $condsIn, $request->condsNotIn, $queryOptions);

            return $paperTypes;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
