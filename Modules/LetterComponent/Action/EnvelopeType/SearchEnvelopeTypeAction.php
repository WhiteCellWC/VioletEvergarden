<?php

namespace Modules\LetterComponent\Action\EnvelopeType;

use Throwable;
use Illuminate\Http\Request;
use Modules\LetterComponent\Contract\EnvelopeTypeServiceInterface;
use Modules\LetterComponent\DTO\SearchEnvelopeTypeDto;
use Modules\Shared\DTO\QueryOptionsDto;

class SearchEnvelopeTypeAction
{
    public function __construct(protected EnvelopeTypeServiceInterface $envelopeTypeService) {}

    public function handle(Request $request, array|string|null $relation = null)
    {
        try {
            $condsIn = SearchEnvelopeTypeDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            $envelopeTypes = $this->envelopeTypeService->getAll($relation, $condsIn, $request->condsNotIn, $queryOptions);

            return $envelopeTypes;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
