<?php

namespace Modules\LetterComponent\Action\FragranceType;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\DTO\FragranceTypeDto;
use Modules\LetterComponent\Http\Cache\FragranceTypeCache;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;
use Modules\Shared\Contract\CoreImageServiceInterface;

class UpdateFragranceTypeAction
{
    public function __construct(
        protected FragranceTypeServiceInterface $fragranceTypeService,
        protected CoreImageServiceInterface $coreImageService
    ) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $fragranceTypeDto = FragranceTypeDto::fromRequest($request, $id);

            $fragranceType = $this->fragranceTypeService->update($fragranceTypeDto);

            if ($fragranceTypeDto->images && count($fragranceTypeDto->images)) {
                $this->coreImageService->attachImages($fragranceType, $fragranceTypeDto->images, '/Uploads/FragranceTypes');
            }

            if ($fragranceTypeDto->deleteImages && count($fragranceTypeDto->deleteImages)) {
                $this->coreImageService->delete($fragranceTypeDto->deleteImages);
            }

            Cache::tags([FragranceTypeCache::GET_ALL, FragranceTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $fragranceType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
