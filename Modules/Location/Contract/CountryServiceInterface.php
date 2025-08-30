<?php

namespace Modules\Location\Contract;

use Modules\Location\DTO\CountryDto;

interface CountryServiceInterface
{
    public function get($id = null, $relations = null, $condsIn = null);

    public function getAll($relations = null, $condsIn = null, $condsNotIn = null, $orderBy = null);

    public function create(CountryDto $countryDto);

    public function update(CountryDto $countryDto);

    public function delete($id, $returnColumn = null);
}
