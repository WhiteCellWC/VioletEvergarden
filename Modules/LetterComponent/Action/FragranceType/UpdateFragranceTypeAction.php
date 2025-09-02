<?php

namespace Modules\LetterComponent\Action\FragranceType;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\DTO\FragranceTypeDto;
use Modules\LetterComponent\Http\Cache\FragranceTypeCache;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;

class UpdateFragranceTypeAction
{
    public function __construct(protected FragranceTypeServiceInterface $fragranceTypeService) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $fragranceTypeDto = FragranceTypeDto::fromRequest($request, $id);

            $fragranceType = $this->fragranceTypeService->update($fragranceTypeDto);

            Cache::forget(FragranceTypeCache::GET . '_' . $fragranceTypeDto->id);
            DB::commit();

            return $fragranceType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
