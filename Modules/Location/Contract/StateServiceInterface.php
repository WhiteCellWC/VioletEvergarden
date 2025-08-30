<?php

namespace Modules\Location\Contract;

interface StateServiceInterface
{
    public function get($id = null, $relations = null, $condsIn = null);
}
