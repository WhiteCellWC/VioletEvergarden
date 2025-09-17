<?php

namespace Modules\Letter\Action\LetterTemplate;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Letter\Contract\LetterTemplateServiceInterface;
use Modules\Letter\DTO\LetterTemplateDto;
use Modules\Letter\Http\Cache\LetterTemplateCache;
use Modules\Letter\Contract\LetterTypeServiceInterface;
use App\Models\LetterTemplate;

class UpdateLetterTemplateAction
{
    public function __construct(
        protected LetterTemplateServiceInterface $letterTemplateServiceInterface,
        protected LetterTypeServiceInterface $letterTypeService
    ) {}

    public function handle(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $letterTemplateDto = LetterTemplateDto::fromRequest($request, $id);

            $letterTemplate = $this->letterTemplateServiceInterface->update($letterTemplateDto);

            if ($letterTemplateDto->letterTypeIds) {
                $this->letterTypeService->attachLetterTypes($letterTemplate, LetterTemplate::letterTypes, $letterTemplateDto->letterTypeIds);
            } else {
                $this->letterTypeService->detachLetterTypes($letterTemplate, LetterTemplate::letterTypes);
            }

            Cache::tags([LetterTemplateCache::GET_ALL, LetterTemplateCache::GET . '_' . $id])->flush();
            DB::commit();

            return $letterTemplate;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
