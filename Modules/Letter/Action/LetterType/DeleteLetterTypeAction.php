<?php

namespace Modules\Letter\Action\LetterType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Letter\Contract\LetterTypeServiceInterface;
use Modules\Letter\Http\Cache\LetterTypeCache;
use Throwable;

class DeleteLetterTypeAction
{
    public function __construct(
        protected LetterTypeServiceInterface $letterTypeService,
    ) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $letterType = $this->letterTypeService->get($id);

            $letterTypeName = $this->letterTypeService->delete($letterType);

            Cache::tags([LetterTypeCache::GET_ALL, LetterTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $letterTypeName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
