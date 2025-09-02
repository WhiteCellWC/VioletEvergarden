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
    public function get(string $id)
    {
        try {
            return Cache::tags([StateCache::GET . "_" . $id])->remember(
                StateCache::GET . "_" . $id,
                StateCache::GET_EXPIRY,
                fn() => State::find($id)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null)
    {
        try {
            $cacheKey = StateCache::GET_ALL . ':' . md5(json_encode([
                'condsIn'   => $condsIn,
                'condsNotIn' => $condsNotIn,
                'orderBy'   => $orderBy,
            ]));

            return Cache::tags([StateCache::GET_ALL])->remember(
                $cacheKey,
                StateCache::GET_ALL_EXPIRY,
                fn() =>
                State::when(
                    $condsIn,
                    fn($query, $condsIn) => $query->condsInByColumns($condsIn)
                )->when(
                    $condsNotIn,
                    fn($query, $condsNotIn) => $query->condsNotInByColumns($condsNotIn)
                )->when(
                    $orderBy,
                    fn($query, $orderBy) => $query->orderByColumns($orderBy)
                )->get()
            );
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
}
