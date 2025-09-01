<?php

namespace Modules\Location\Action\Country;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\DTO\CountryDto;
use Modules\Location\Http\Cache\CountryCache;
use Throwable;

class UpdateCountryAction
{
    public function __construct(protected CountryServiceInterface $countryService) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $countryDto = CountryDto::fromRequest($request, $id);

            $country = $this->countryService->update($countryDto);

            Cache::forget(CountryCache::GET . '_' . $countryDto->id);
            DB::commit();

            return $country;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
