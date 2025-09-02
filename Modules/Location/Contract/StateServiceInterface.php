<?php

namespace Modules\Location\Contract;

use Modules\Location\DTO\StateDto;

interface StateServiceInterface
{
    public function get(string $id);

    public function getAll(?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null);

    public function create(StateDto $stateDto);

    public function update(StateDto $stateDto);

    public function delete(string $id);
}
