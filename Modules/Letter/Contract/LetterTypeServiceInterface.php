<?php

namespace Modules\Letter\Contract;

use App\Models\LetterType;
use Modules\Letter\DTO\LetterTypeDto;

interface LetterTypeServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(string|array|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(LetterTypeDto $letterTemplateDto);

    public function update(LetterTypeDto $letterTemplateDto);

    public function delete(string|LetterType $id);
}
