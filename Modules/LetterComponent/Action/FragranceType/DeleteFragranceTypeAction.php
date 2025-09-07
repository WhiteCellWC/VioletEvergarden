<?php

namespace Modules\LetterComponent\Action\FragranceType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Http\Cache\FragranceTypeCache;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;
use Modules\Shared\Contract\CoreImageServiceInterface;
use Throwable;

class DeleteFragranceTypeAction
{
    public function __construct(
        protected FragranceTypeServiceInterface $fragranceTypeService,
        protected CoreImageServiceInterface $coreImageService
    ) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $fragranceType = $this->fragranceTypeService->get($id);

            $this->coreImageService->detachImages($fragranceType);

            $fragranceTypeName = $this->fragranceTypeService->delete($fragranceType);

            Cache::tags([FragranceTypeCache::GET_ALL, FragranceTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $fragranceTypeName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
