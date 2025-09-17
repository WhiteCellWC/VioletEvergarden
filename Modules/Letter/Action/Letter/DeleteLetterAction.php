<?php

namespace Modules\Letter\Action\Letter;

use App\Models\Letter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Letter\Contract\LetterServiceInterface;
use Modules\Letter\Contract\LetterTypeServiceInterface;
use Modules\Letter\Http\Cache\LetterCache;
use Throwable;

class DeleteLetterAction
{
    public function __construct(
        protected LetterServiceInterface $letterService,
        protected LetterTypeServiceInterface $letterTypeService
    ) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $letter = $this->letterService->get($id);

            $this->letterTypeService->detachLetterTypes($letter, Letter::letterTypes);

            $letterName = $this->letterService->delete($letter);

            Cache::tags([LetterCache::GET_ALL, LetterCache::GET . '_' . $id])->flush();
            DB::commit();

            return $letterName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
