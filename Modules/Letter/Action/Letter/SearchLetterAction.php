<?php

namespace Modules\Letter\Action\Letter;

use Throwable;
use Illuminate\Http\Request;
use Modules\Letter\Contract\LetterServiceInterface;
use Modules\Letter\DTO\SearchLetterDto;
use Modules\Shared\DTO\QueryOptionsDto;

class SearchLetterAction
{
    public function __construct(protected LetterServiceInterface $letterService) {}

    public function handle(Request $request, array|string|null $relation = null)
    {
        try {
            $condsIn = SearchLetterDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            $letters = $this->letterService->getAll($relation, $condsIn, $request->condsNotIn, $queryOptions);

            return $letters;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
