<?php

namespace Modules\Location\Action\Country;

use Illuminate\Http\Request;
use Modules\Location\DTO\SearchCountryDto;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Shared\DTO\QueryOptionsDto;
use Throwable;

class SearchCountryAction
{
    public function __construct(protected CountryServiceInterface $countryService) {}

    public function handle(Request $request, array|string|null $relation = null)
    {
        try {
            $condsIn = SearchCountryDto::fromRequest($request)->toArray();

            $queryOptions = QueryOptionsDto::fromRequest($request)->toArray();

            /**
             * @todo condsNotIn need to be implmented
             */
            $countries = $this->countryService->getAll($relation, $condsIn, [], $queryOptions);

            return $countries;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
