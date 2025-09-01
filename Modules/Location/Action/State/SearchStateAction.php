<?php

namespace Modules\Location\Action\State;

use Illuminate\Http\Request;
use Modules\Location\Contract\StateServiceInterface;
use Throwable;

class SearchStateAction
{
    public function __construct(protected StateServiceInterface $stateService) {}

    public function handle(Request $request)
    {
        try {
            $states = $this->stateService->getAll([], $request->condsIn, $request->condsNotIn, $request->orderBy);

            return $states;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
