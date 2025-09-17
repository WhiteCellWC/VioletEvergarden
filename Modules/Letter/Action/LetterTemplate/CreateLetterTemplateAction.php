<?php

namespace Modules\Letter\Action\LetterTemplate;

use App\Models\LetterTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Letter\Contract\LetterTemplateServiceInterface;
use Modules\Letter\Contract\LetterTypeServiceInterface;
use Modules\Letter\DTO\LetterTemplateDto;
use Modules\Letter\Http\Cache\LetterTemplateCache;
use Throwable;

class CreateLetterTemplateAction
{
    public function __construct(
        protected LetterTemplateServiceInterface $letterTemplateService,
        protected LetterTypeServiceInterface $letterTypeService
    ) {}

    public function handle(Request $request)
    {
        DB::beginTransaction();
        try {
            $letterTemplateDto = LetterTemplateDto::fromRequest($request);

            $letterTemplate = $this->letterTemplateService->create($letterTemplateDto);

            if ($letterTemplateDto->letterTypeIds) {
                $this->letterTypeService->attachLetterTypes($letterTemplate, LetterTemplate::letterTypes, $letterTemplateDto->letterTypeIds);
            }

            Cache::tags([LetterTemplateCache::GET_ALL])->flush();
            DB::commit();

            return $letterTemplate;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
