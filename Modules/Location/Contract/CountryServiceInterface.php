<?php

namespace Modules\Location\Contract;

use Modules\Location\DTO\CountryDto;

interface CountryServiceInterface
{
    public function get(string $id);

    public function getAll(?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null);

    public function create(CountryDto $countryDto);

    public function update(CountryDto $countryDto);

    public function delete(string $id);
}
