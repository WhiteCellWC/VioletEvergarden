<?php

namespace Modules\Location\Action\State;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Location\Contract\StateServiceInterface;
use Modules\Location\Http\Cache\CountryCache;
use Modules\Location\Http\Cache\StateCache;
use Throwable;

class DeleteStateAction
{
    public function __construct(protected StateServiceInterface $stateService) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $stateName = $this->stateService->delete($id);

            Cache::tags([StateCache::GET_ALL, StateCache::GET . '_' . $id])->flush();
            Cache::tags([CountryCache::GET_ALL, CountryCache::GET])->flush();
            DB::commit();

            return $stateName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
