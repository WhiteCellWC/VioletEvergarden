<?php

namespace Modules\Location\Action\State;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Location\Contract\StateServiceInterface;
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

            Cache::forget(StateCache::GET_ALL);
            Cache::forget(StateCache::GET . '_' . $id);
            DB::commit();

            return $stateName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
