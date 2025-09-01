<?php

namespace Modules\Location\Http\Service;

use App\Models\Country;
use Exception;
use Illuminate\Support\Facades\Cache;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\DTO\CountryDto;
use Modules\Location\Http\Cache\CountryCache;

class CountryService implements CountryServiceInterface
{
    public function get($id, ?array $relations = null, ?array $condsIn = null)
    {
        try {
            return Cache::remember(CountryCache::GET . "_" . $id, CountryCache::GET_EXPIRY, function () use ($id, $relations, $condsIn) {
                return Country::when(
                    $id,
                    fn($query, $id) => $query->where(Country::id, $id)
                )->when(
                    $relations,
                    fn($query, $relations) => $query->with($relations)
                )->when(
                    $condsIn,
                    fn($query, $condsIn) => $query->condsInByColumns($condsIn)
                )->first();
            });
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(?array $relations = null, ?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null)
    {
        try {
            return Cache::remember(CountryCache::GET_ALL, CountryCache::GET_ALL_EXPIRY, function () use ($relations, $condsIn, $condsNotIn, $orderBy) {
                return Country::when(
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

    // Private Functions
}
