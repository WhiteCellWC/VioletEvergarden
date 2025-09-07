<?php

namespace Modules\LetterComponent\Action\PaperType;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Contract\PaperTypeServiceInterface;
use Modules\LetterComponent\DTO\PaperTypeDto;
use Modules\LetterComponent\Http\Cache\PaperTypeCache;

class UpdatePaperTypeAction
{
    public function __construct(protected PaperTypeServiceInterface $paperTypeService) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $paperTypeDto = PaperTypeDto::fromRequest($request, $id);

            $paperType = $this->paperTypeService->update($paperTypeDto);

            Cache::tags([PaperTypeCache::GET_ALL, PaperTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $paperType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
