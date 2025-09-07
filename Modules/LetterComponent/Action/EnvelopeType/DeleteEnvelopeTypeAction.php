<?php

namespace Modules\LetterComponent\Action\EnvelopeType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Contract\EnvelopeTypeServiceInterface;
use Modules\LetterComponent\Http\Cache\EnvelopeTypeCache;
use Modules\Shared\Contract\CoreImageServiceInterface;
use Throwable;

class DeleteEnvelopeTypeAction
{
    public function __construct(
        protected EnvelopeTypeServiceInterface $envelopeTypeService,
        protected CoreImageServiceInterface $coreImageService
    ) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $envelopeType = $this->envelopeTypeService->get($id);

            $this->coreImageService->detachImages($envelopeType);

            $envelopeTypeName = $this->envelopeTypeService->delete($envelopeType);

            Cache::tags([EnvelopeTypeCache::GET_ALL, EnvelopeTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $envelopeTypeName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
