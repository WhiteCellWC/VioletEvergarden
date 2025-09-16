<?php

namespace Modules\Letter\Action\LetterTemplate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Letter\Contract\LetterTemplateServiceInterface;
use Modules\Letter\DTO\LetterTemplateDto;
use Modules\Letter\Http\Cache\LetterTemplateCache;
use Throwable;

class CreateLetterTemplateAction
{
    public function __construct(
        protected LetterTemplateServiceInterface $letterTemplateService,
    ) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $letterTemplateDto = LetterTemplateDto::fromRequest($request);

            $letterTemplate = $this->letterTemplateService->create($letterTemplateDto);

            Cache::tags([LetterTemplateCache::GET_ALL])->flush();
            DB::commit();

            return $letterTemplate;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
