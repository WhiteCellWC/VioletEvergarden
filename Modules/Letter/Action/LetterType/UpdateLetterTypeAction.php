<?php

namespace Modules\Letter\Action\LetterType;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Letter\Contract\LetterTypeServiceInterface;
use Modules\Letter\DTO\LetterTypeDto;
use Modules\Letter\Http\Cache\LetterTypeCache;

class UpdateLetterTypeAction
{
    public function __construct(
        protected LetterTypeServiceInterface $letterTypeServiceInterface,
    ) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $letterTypeDto = LetterTypeDto::fromRequest($request, $id);

            $letterType = $this->letterTypeServiceInterface->update($letterTypeDto);

            Cache::tags([LetterTypeCache::GET_ALL, LetterTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $letterType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
