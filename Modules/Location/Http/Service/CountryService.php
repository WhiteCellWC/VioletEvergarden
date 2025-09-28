<?php

namespace Modules\Location\Http\Service;

use App\Http\Service\BaseService;
use App\Models\Country;
use Exception;
use Illuminate\Support\Facades\Cache;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\DTO\CountryDto;
use Modules\Location\Http\Cache\CountryCache;
use Modules\Shared\DTO\QueryOptionsDto;

class CountryService extends BaseService implements CountryServiceInterface
{
    public function get(string $id, array|string|null $relation = null)
    {
        try {
            $cacheKey = CountryCache::GET . '_' . $id . ':' . md5(json_encode([
                'relation' => $relation
            ]));
            return Cache::tags([CountryCache::GET, CountryCache::GET . "_" . $id])->remember(
                $cacheKey,
                CountryCache::GET_EXPIRY,
                fn() => Country::when(
                    $id,
                    fn($query, $id) => $query->where(Country::id, $id)
                )->when(
                    $relation,
                    fn($query, $relation) => $query->with($relation)
                )->first()
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(array|string|null $relation = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $queryOptions = null)
    {
        try {
            $cacheKey = CountryCache::GET_ALL . ':' . md5(json_encode([
                'relation' => $relation,
                'condsIn'   => $condsIn,
                'condsNotIn' => $condsNotIn,
                'queryOptions'   => $queryOptions,
                'routeType' => request()->is('api/*') ? 'api' : 'web'
            ]));

            return Cache::tags([CountryCache::GET_ALL])->remember(
                $cacheKey,
                CountryCache::GET_ALL_EXPIRY,
                fn() => $this->fetch(
                    Country::when(
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

    public function create(CountryDto $countryDto)
    {
        try {
            return Country::create($countryDto->toArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(CountryDto $countryDto)
    {
        try {
            $country = $this->get($countryDto->id);
            $country->fill($countryDto->toArray());
            $country->save();

            return $country;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(string $id)
    {
        try {
            $country = $this->get($id);
            $name = $country->{Country::name};
            $country->delete();

            return $name;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
