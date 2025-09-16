<?php

namespace Modules\Letter\Action\LetterTemplate;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Letter\Contract\LetterTemplateServiceInterface;
use Modules\Letter\Http\Cache\LetterTemplateCache;
use Throwable;

class DeleteLetterTemplateAction
{
    public function __construct(
        protected LetterTemplateServiceInterface $letterTemplateService,
    ) {}

    public function handle(string $id)
    {
        DB::beginTransaction();
        try {
            $letterTemplate = $this->letterTemplateService->get($id);

            $letterTemplateName = $this->letterTemplateService->delete($letterTemplate);

            Cache::tags([LetterTemplateCache::GET_ALL, LetterTemplateCache::GET . '_' . $id])->flush();
            DB::commit();

            return $letterTemplateName;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
