<?php

namespace Modules\Location\Action\Country;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\DTO\CountryDto;
use Modules\Location\Http\Cache\CountryCache;
use Throwable;

class CreateCountryAction
{
    public function __construct(protected CountryServiceInterface $countryService) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $countryDto = CountryDto::fromRequest($request);

            $country = $this->countryService->create($countryDto);

            Cache::tags([CountryCache::GET_ALL])->flush();
            DB::commit();

            return $country;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
