<?php

namespace Modules\LetterComponent\Action\EnvelopeType;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Contract\EnvelopeTypeServiceInterface;
use Modules\LetterComponent\DTO\EnvelopeTypeDto;
use Modules\LetterComponent\Http\Cache\EnvelopeTypeCache;
use Modules\Shared\Contract\CoreImageServiceInterface;

class UpdateEnvelopeTypeAction
{
    public function __construct(
        protected EnvelopeTypeServiceInterface $envelopeTypeService,
        protected CoreImageServiceInterface $coreImageService,
    ) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $envelopeTypeDto = EnvelopeTypeDto::fromRequest($request, $id);

            $envelopeType = $this->envelopeTypeService->update($envelopeTypeDto);

            if ($envelopeTypeDto->images && count($envelopeTypeDto->images)) {
                $this->coreImageService->attachImages($envelopeType, $envelopeTypeDto->images, '/Uploads/EnvelopeTypes');
            }

            if ($envelopeTypeDto->deleteImages && count($envelopeTypeDto->deleteImages)) {
                $this->coreImageService->delete($envelopeTypeDto->deleteImages);
            }

            Cache::tags([EnvelopeTypeCache::GET_ALL, EnvelopeTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $envelopeType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
