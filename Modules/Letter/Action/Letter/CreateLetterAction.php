<?php

namespace Modules\Letter\Action\Letter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Letter\Contract\LetterServiceInterface;
use Modules\Letter\DTO\LetterDto;
use Modules\Letter\Http\Cache\LetterCache;
use Throwable;

class CreateLetterAction
{
    public function __construct(
        protected LetterServiceInterface $letterService,
    ) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $letterDto = LetterDto::fromRequest($request);

            $letter = $this->letterService->create($letterDto);

            Cache::tags([LetterCache::GET_ALL])->flush();
            DB::commit();

            return $letter;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
