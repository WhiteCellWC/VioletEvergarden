<?php

namespace Modules\Letter\Contract;

use App\Models\LetterTemplate;
use Modules\Letter\DTO\LetterTemplateDto;

interface LetterTemplateServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(string|array|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(LetterTemplateDto $letterTemplateDto);

    public function update(LetterTemplateDto $letterTemplateDto);

    public function delete(string|LetterTemplate $id);
}
