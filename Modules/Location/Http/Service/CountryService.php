<?php

namespace Modules\Location\Http\Service;

use App\Models\Country;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Cache;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\Contract\StateServiceInterface;
use Modules\Location\DTO\CountryDto;
use Modules\Location\Http\Cache\CountryCache;

class CountryService implements CountryServiceInterface
{
    public function get($id)
    {
        try {
            return Cache::tags([CountryCache::GET . "_" . $id])->remember(
                CountryCache::GET . "_" . $id,
                CountryCache::GET_EXPIRY,
                fn() => Country::find($id)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(?array $condsIn = null, ?array $condsNotIn = null, ?array $orderBy = null)
    {
        try {
            $cacheKey = CountryCache::GET_ALL . ':' . md5(json_encode([
                'condsIn'   => $condsIn,
                'condsNotIn' => $condsNotIn,
                'orderBy'   => $orderBy,
            ]));

            return Cache::tags([CountryCache::GET_ALL])->remember(
                $cacheKey,
                CountryCache::GET_ALL_EXPIRY,
                fn() =>
                Country::when(
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
