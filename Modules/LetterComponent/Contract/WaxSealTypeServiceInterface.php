<?php

namespace Modules\LetterComponent\Contract;

use App\Models\WaxSealType;
use Modules\LetterComponent\DTO\WaxSealTypeDto;

interface WaxSealTypeServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(string|array|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(WaxSealTypeDto $fragranceTypeDto);

    public function update(WaxSealTypeDto $fragranceTypeDto);

    public function delete(string|WaxSealType $id);
}
