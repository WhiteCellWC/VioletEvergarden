<?php

namespace Modules\Location\Action\Country;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\Http\Cache\CountryCache;
use Modules\Location\Http\Cache\StateCache;
use Throwable;

class DeleteCountryAction
{
    public function __construct(protected CountryServiceInterface $countryService) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $countryName = $this->countryService->delete($id);

            Cache::tags([CountryCache::GET_ALL, CountryCache::GET . '_' . $id])->flush();
            Cache::tags([StateCache::GET_ALL, StateCache::GET])->flush();
            DB::commit();

            return $countryName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
