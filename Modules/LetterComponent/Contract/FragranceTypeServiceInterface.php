<?php

namespace Modules\LetterComponent\Contract;

use App\Models\FragranceType;
use Modules\LetterComponent\DTO\FragranceTypeDto;

interface FragranceTypeServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(string|array|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(FragranceTypeDto $fragranceTypeDto);

    public function update(FragranceTypeDto $fragranceTypeDto);

    public function delete(string|FragranceType $id);
}
