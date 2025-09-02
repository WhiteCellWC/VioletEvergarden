<?php

namespace Modules\LetterComponent\Action\FragranceType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;
use Modules\LetterComponent\DTO\FragranceTypeDto;
use Modules\LetterComponent\Http\Cache\FragranceTypeCache;
use Throwable;

class CreateFragranceTypeAction
{
    public function __construct(protected FragranceTypeServiceInterface $fragranceTypeService) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $fragranceTypeDto = FragranceTypeDto::fromRequest($request);

            $fragranceType = $this->fragranceTypeService->create($fragranceTypeDto);

            Cache::forget(FragranceTypeCache::GET_ALL);
            DB::commit();

            return $fragranceType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
