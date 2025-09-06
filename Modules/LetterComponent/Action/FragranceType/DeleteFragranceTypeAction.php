<?php

namespace Modules\LetterComponent\Action\FragranceType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Http\Cache\FragranceTypeCache;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;
use Throwable;

class DeleteFragranceTypeAction
{
    public function __construct(protected FragranceTypeServiceInterface $fragranceTypeService) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $fragranceTypeName = $this->fragranceTypeService->delete($id);

            Cache::tags([FragranceTypeCache::GET_ALL, FragranceTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $fragranceTypeName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
