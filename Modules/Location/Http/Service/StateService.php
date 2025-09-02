<?php

namespace Modules\Location\Http\Service;

use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Cache;
use Modules\Location\Contract\StateServiceInterface;
use Modules\Location\DTO\StateDto;
use Modules\Location\Http\Cache\StateCache;

class StateService implements StateServiceInterface
{
    public function get(string $id, ?array $relations = null)
    {
        try {
            return Cache::remember(StateCache::GET . "_" . $id, StateCache::GET_EXPIRY, function () use ($id, $relations) {
                return State::when(
                    $id,
                    fn($query, $id) => $query->where(State::id, $id)
                )->when(
                    $relations,
                    fn($query, $relations) => $query->with($relations)
                )->first();
            });
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(?array $relations = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null)
    {
        try {
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
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function create(StateDto $stateDto)
    {
        try {
            return State::create($stateDto->toArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(StateDto $stateDto)
    {
        try {
            $state = $this->get($stateDto->id);
            $state->fill($stateDto->toArray());
            $state->save();

            return $state;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(string $id)
    {
        try {
            $state = $this->get($id);
            $name = $state->{State::name};
            $state->delete();

            return $name;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Private Functions
}
