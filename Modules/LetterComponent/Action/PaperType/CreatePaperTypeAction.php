<?php

namespace Modules\LetterComponent\Action\PaperType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\LetterComponent\Contract\PaperTypeServiceInterface;
use Modules\LetterComponent\DTO\PaperTypeDto;
use Modules\LetterComponent\Http\Cache\PaperTypeCache;
use Throwable;

class CreatePaperTypeAction
{
    public function __construct(protected PaperTypeServiceInterface $paperTypeService) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $paperTypeDto = PaperTypeDto::fromRequest($request);

            $paperType = $this->paperTypeService->create($paperTypeDto);

            Cache::tags([PaperTypeCache::GET_ALL])->flush();
            DB::commit();

            return $paperType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
