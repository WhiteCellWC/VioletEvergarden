<?php

namespace Modules\Location\Action\State;

use Illuminate\Http\Request;
use Modules\Location\DTO\SearchStateDto;
use Modules\Location\Contract\StateServiceInterface;
use Modules\Shared\DTO\QueryOptionsDto;
use Throwable;

class SearchStateAction
{
    public function __construct(protected StateServiceInterface $stateService) {}

    public function handle(Request $request, string|array|null $relation = null)
    {
        try {
            $condsIn = SearchStateDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            /**
             * @todo condsNotIn need to be implmented
             */
            $states = $this->stateService->getAll($relation, $condsIn, [], $queryOptions);

            return $states;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
