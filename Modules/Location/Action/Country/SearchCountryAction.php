<?php

namespace Modules\Location\Action\Country;

use Illuminate\Http\Request;
use Modules\Location\DTO\SearchCountryDto;
use Modules\Location\Contract\CountryServiceInterface;
use Throwable;

class SearchCountryAction
{
    public function __construct(protected CountryServiceInterface $countryService) {}

    public function handle(Request $request)
    {
        try {
            $condsIn = SearchCountryDto::fromRequest($request)->toArray();

            /**
             * @todo condsIn need to be implmented
             */
            $countries = $this->countryService->getAll($condsIn, [], $request->orderBy);

            return $countries;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
