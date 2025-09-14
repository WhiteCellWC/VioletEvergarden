<?php

namespace Modules\LetterComponent\Action\WaxSealType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\LetterComponent\Contract\WaxSealTypeServiceInterface;
use Modules\LetterComponent\DTO\WaxSealTypeDto;
use Modules\LetterComponent\Http\Cache\WaxSealTypeCache;
use Modules\Shared\Contract\CoreImageServiceInterface;
use Throwable;

class CreateWaxSealTypeAction
{
    public function __construct(
        protected WaxSealTypeServiceInterface $waxSealTypeService,
        protected CoreImageServiceInterface $coreImageService
    ) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $waxSealTypeDto = WaxSealTypeDto::fromRequest($request);

            $waxSealType = $this->waxSealTypeService->create($waxSealTypeDto);

            $this->coreImageService->attachImages($waxSealType, $waxSealTypeDto->images, '/Uploads/WaxSealTypes');

            Cache::tags([WaxSealTypeCache::GET_ALL])->flush();
            DB::commit();

            return $waxSealType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
