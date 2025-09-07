<?php

namespace Modules\LetterComponent\Contract;

use Modules\LetterComponent\DTO\PaperTypeDto;

interface PaperTypeServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(string|array|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(PaperTypeDto $fragranceTypeDto);

    public function update(PaperTypeDto $fragranceTypeDto);

    public function delete(string $id);
}
