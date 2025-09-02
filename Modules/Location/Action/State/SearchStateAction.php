<?php

namespace Modules\Location\Action\State;

use Illuminate\Http\Request;
use Modules\Location\DTO\SearchStateDto;
use Modules\Location\Contract\StateServiceInterface;
use Throwable;

class SearchStateAction
{
    public function __construct(protected StateServiceInterface $stateService) {}

    public function handle(Request $request)
    {
        try {
            $condsIn = SearchStateDto::fromRequest($request)->toArray();

            $states = $this->stateService->getAll($condsIn, [], $request->orderBy);

            return $states;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
