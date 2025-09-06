<?php

namespace App\Http\Service;

use Modules\Shared\DTO\QueryOptionsDto;

class BaseService
{
    protected function fetch($query, ?array $queryOptions)
    {
        $noPagination = $queryOptions[QueryOptionsDto::noPagination] ?? false;
        $perPage      = $queryOptions[QueryOptionsDto::pagPerPage] ?? null;

        if ($noPagination) {
            return $query->get();
        }

        return $perPage
            ? $query->paginate($perPage)->withQueryString()
            : $query->get();
    }
}
