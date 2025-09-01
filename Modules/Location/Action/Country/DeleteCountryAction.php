<?php

namespace Modules\Location\Action\Country;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\Http\Cache\CountryCache;
use Throwable;

class DeleteCountryAction
{
    public function __construct(protected CountryServiceInterface $countryService) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $countryName = $this->countryService->delete($id);

            Cache::forget(CountryCache::GET_ALL);
            Cache::forget(CountryCache::GET . '_' . $id);
            DB::commit();

            return $countryName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
