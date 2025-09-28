<?php

namespace Modules\Location\Http\Service;

use App\Http\Service\BaseService;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Cache;
use Modules\Location\Contract\StateServiceInterface;
use Modules\Location\DTO\StateDto;
use Modules\Location\Http\Cache\StateCache;

class StateService extends BaseService implements StateServiceInterface
{
    public function get(string $id, string|array|null $relation = null)
    {
        try {
            $cacheKey = StateCache::GET . '_' . $id . ':' . md5(json_encode([
                'relation' => $relation
            ]));
            return Cache::tags([StateCache::GET, StateCache::GET . "_" . $id])->remember(
                $cacheKey,
                StateCache::GET_EXPIRY,
                fn() => State::when(
                    $id,
                    fn($query, $id) => $query->where(State::id, $id)
                )->when(
                    $relation,
                    fn($query, $relation) => $query->with($relation)
                )->first()
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(string|array|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null)
    {
        try {
            $cacheKey = StateCache::GET_ALL . ':' . md5(json_encode([
                'relation' => $relation,
                'condsIn'   => $condsIn,
                'condsNotIn' => $condsNotIn,
                'queryOptions'   => $queryOptions,
            ]));

            return Cache::tags([StateCache::GET_ALL])->remember(
                $cacheKey,
                StateCache::GET_ALL_EXPIRY,
                fn() => $this->fetch(
                    State::when(
                        $relation,
                        fn($query, $relation) => $query->with($relation)
                    )->when(
                        $condsIn,
                        fn($query, $condsIn) => $query->condsInByColumns($condsIn)
                    )->when(
                        $condsNotIn,
                        fn($query, $condsNotIn) => $query->condsNotInByColumns($condsNotIn)
                    )->when(
                        $queryOptions,
                        fn($query, $queryOptions) => $query->queryOptions($queryOptions)
                    ),
                    $queryOptions
                )
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
