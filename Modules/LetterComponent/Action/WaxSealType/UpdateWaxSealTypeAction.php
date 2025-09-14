<?php

namespace Modules\LetterComponent\Action\WaxSealType;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Contract\WaxSealTypeServiceInterface;
use Modules\LetterComponent\DTO\WaxSealTypeDto;
use Modules\LetterComponent\Http\Cache\WaxSealTypeCache;
use Modules\Shared\Contract\CoreImageServiceInterface;

class UpdateWaxSealTypeAction
{
    public function __construct(
        protected WaxSealTypeServiceInterface $waxSealTypeService,
        protected CoreImageServiceInterface $coreImageService
    ) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $waxSealTypeDto = WaxSealTypeDto::fromRequest($request, $id);

            $waxSealType = $this->waxSealTypeService->update($waxSealTypeDto);

            if ($waxSealTypeDto->images && count($waxSealTypeDto->images)) {
                $this->coreImageService->attachImages($waxSealType, $waxSealTypeDto->images, '/Uploads/WaxSealTypes');
            }

            if ($waxSealTypeDto->deleteImages && count($waxSealTypeDto->deleteImages)) {
                $this->coreImageService->delete($waxSealTypeDto->deleteImages);
            }

            Cache::tags([WaxSealTypeCache::GET_ALL, WaxSealTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $waxSealType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
