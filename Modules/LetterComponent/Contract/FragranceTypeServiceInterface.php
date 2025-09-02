<?php

namespace Modules\LetterComponent\Contract;

use Modules\LetterComponent\DTO\FragranceTypeDto;

interface FragranceTypeServiceInterface
{
    public function get(string $id, ?array $relations = null);

    public function getAll(?array $relations = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null);

    public function create(FragranceTypeDto $fragranceTypeDto);

    public function update(FragranceTypeDto $fragranceTypeDto);

    public function delete(string $id);
}
