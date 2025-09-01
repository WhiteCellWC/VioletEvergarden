<?php

namespace Modules\Location\Action\Country;

use Illuminate\Http\Request;
use Modules\Location\Contract\CountryServiceInterface;
use Throwable;

class SearchCountryAction
{
    public function __construct(protected CountryServiceInterface $countryService) {}

    public function handle(Request $request)
    {
        try {
            $countries = $this->countryService->getAll([], $request->condsIn, $request->condsNotIn, $request->orderBy);

            return $countries;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
