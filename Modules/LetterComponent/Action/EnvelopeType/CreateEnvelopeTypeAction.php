<?php

namespace Modules\LetterComponent\Action\EnvelopeType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\LetterComponent\Contract\EnvelopeTypeServiceInterface;
use Modules\LetterComponent\DTO\EnvelopeTypeDto;
use Modules\LetterComponent\Http\Cache\EnvelopeTypeCache;
use Throwable;

class CreateEnvelopeTypeAction
{
    public function __construct(protected EnvelopeTypeServiceInterface $envelopeTypeService) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $envelopeTypeDto = EnvelopeTypeDto::fromRequest($request);

            $envelopeType = $this->envelopeTypeService->create($envelopeTypeDto);

            Cache::tags([EnvelopeTypeCache::GET_ALL])->flush();
            DB::commit();

            return $envelopeType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
