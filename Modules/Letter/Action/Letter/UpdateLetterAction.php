<?php

namespace Modules\Letter\Action\Letter;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Letter\Contract\LetterServiceInterface;
use Modules\Letter\DTO\LetterDto;
use Modules\Letter\Http\Cache\LetterCache;

class UpdateLetterAction
{
    public function __construct(
        protected LetterServiceInterface $letterServiceInterface,
    ) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $letterDto = LetterDto::fromRequest($request, $id);

            $letter = $this->letterServiceInterface->update($letterDto);

            Cache::tags([LetterCache::GET_ALL, LetterCache::GET . '_' . $id])->flush();
            DB::commit();

            return $letter;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
