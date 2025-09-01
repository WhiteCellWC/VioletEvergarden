<?php

namespace Modules\Location\Contract;

use Modules\Location\DTO\CountryDto;

interface CountryServiceInterface
{
    public function get(string $id, ?array $relations = null, ?array $condsIn = null);

    public function getAll(?array $relations = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null);

    public function create(CountryDto $countryDto);

    public function update(CountryDto $countryDto);

    public function delete(string $id);
}
