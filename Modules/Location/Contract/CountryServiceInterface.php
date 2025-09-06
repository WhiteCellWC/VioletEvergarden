<?php

namespace Modules\Location\Contract;

use Modules\Location\DTO\CountryDto;

interface CountryServiceInterface
{
    public function get(string $id, string|array|null $relation = null);

    public function getAll(array|string|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null);

    public function create(CountryDto $countryDto);

    public function update(CountryDto $countryDto);

    public function delete(string $id);
}
