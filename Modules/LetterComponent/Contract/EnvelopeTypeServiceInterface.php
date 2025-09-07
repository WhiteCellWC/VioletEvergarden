<?php

namespace Modules\LetterComponent\Contract;

use App\Models\EnvelopeType;
use Modules\LetterComponent\DTO\EnvelopeTypeDto;

interface EnvelopeTypeServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(string|array|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(EnvelopeTypeDto $fragranceTypeDto);

    public function update(EnvelopeTypeDto $fragranceTypeDto);

    public function delete(string|EnvelopeType $id);
}
