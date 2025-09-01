<?php

namespace Modules\Location\Action\State;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Location\Contract\StateServiceInterface;
use Modules\Location\DTO\StateDto;
use Modules\Location\Http\Cache\StateCache;
use Throwable;

class UpdateStateAction
{
    public function __construct(protected StateServiceInterface $stateService) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $stateDto = StateDto::fromRequest($request, $id);

            $state = $this->stateService->update($stateDto);

            Cache::forget(StateCache::GET . '_' . $stateDto->id);
            DB::commit();

            return $state;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
