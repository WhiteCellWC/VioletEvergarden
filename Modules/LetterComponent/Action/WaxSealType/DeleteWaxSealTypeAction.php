<?php

namespace Modules\LetterComponent\Action\WaxSealType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Contract\WaxSealTypeServiceInterface;
use Modules\LetterComponent\Http\Cache\WaxSealTypeCache;
use Modules\Shared\Contract\CoreImageServiceInterface;
use Throwable;

class DeleteWaxSealTypeAction
{
    public function __construct(
        protected WaxSealTypeServiceInterface $waxSealTypeService,
        protected CoreImageServiceInterface $coreImageService
    ) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $waxSealType = $this->waxSealTypeService->get($id);

            $this->coreImageService->detachImages($waxSealType);

            $waxSealTypeName = $this->waxSealTypeService->delete($id);

            Cache::tags([WaxSealTypeCache::GET_ALL, WaxSealTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $waxSealTypeName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
