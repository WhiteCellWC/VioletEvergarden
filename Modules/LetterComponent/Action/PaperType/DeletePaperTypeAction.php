<?php

namespace Modules\LetterComponent\Action\PaperType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Contract\PaperTypeServiceInterface;
use Modules\LetterComponent\Http\Cache\PaperTypeCache;
use Throwable;

class DeletePaperTypeAction
{
    public function __construct(protected PaperTypeServiceInterface $paperTypeService) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $paperTypeName = $this->paperTypeService->delete($id);

            Cache::tags([PaperTypeCache::GET_ALL, PaperTypeCache::GET . '_' . $id])->flush();
            DB::commit();

            return $paperTypeName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
