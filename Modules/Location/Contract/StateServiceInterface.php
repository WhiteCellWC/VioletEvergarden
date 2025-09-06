<?php

namespace Modules\Location\Contract;

use Modules\Location\DTO\StateDto;

interface StateServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(string|array|null $relation = null,?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(StateDto $stateDto);

    public function update(StateDto $stateDto);

    public function delete(string $id);
}
