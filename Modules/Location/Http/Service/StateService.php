<?php

namespace Modules\Location\Http\Service;

use App\Models\State;
use Illuminate\Support\Facades\Cache;
use Modules\Location\Contract\StateServiceInterface;
use Modules\Location\Http\Cache\StateCache;

class StateService implements StateServiceInterface
{
    public function get($id = null, $relations = null, $condsIn = null)
    {
        return Cache::remember(StateCache::GET . "_" . $id, StateCache::GET_EXPIRY, function () use ($id, $relations, $condsIn) {
            return State::when(
                $id,
                fn($query, $id) => $query->where(State::id, $id)
            )->when(
                $relations,
                fn($query, $relations) => $query->with($relations)
            )->when(
                $condsIn,
                fn($query, $condsIn) => $query->condsInByColumns($condsIn)
            )->first();
        });
    }

    public function getAll($relations = null, $condsIn = null, $condsNotIn = null, $orderBy = null)
    {
        return Cache::remember(StateCache::GET_ALL, StateCache::GET_ALL_EXPIRY, function () use ($relations, $condsIn, $condsNotIn, $orderBy) {
            return State::when(
                $relations,
                fn($query, $relations) => $query->with($relations)
            )->when(
                $condsIn,
                fn($query, $condsIn) => $query->condsInByColumns($condsIn)
            )->when(
                $condsNotIn,
                fn($query, $condsNotIn) => $query->condsNotInByColumns($condsNotIn)
            )->when(
                $orderBy,
                fn($query, $orderBy) => $query->orderByColumns($orderBy)
            )->get();
        });
    }

    public function create()
    {
        //
    }

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }

    // Private Functions
}
