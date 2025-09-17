<?php

namespace Modules\Letter\Action\LetterType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Letter\Contract\LetterTypeServiceInterface;
use Modules\Letter\DTO\LetterTypeDto;
use Modules\Letter\Http\Cache\LetterTypeCache;
use Throwable;

class CreateLetterTypeAction
{
    public function __construct(
        protected LetterTypeServiceInterface $letterTypeService,
    ) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $letterTypeDto = LetterTypeDto::fromRequest($request);

            $letterType = $this->letterTypeService->create($letterTypeDto);

            Cache::tags([LetterTypeCache::GET_ALL])->flush();
            DB::commit();

            return $letterType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
