<?php

namespace Modules\LetterComponent\Http\Service;

use App\Models\FragranceType;
use Exception;
use Illuminate\Support\Facades\Cache;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;
use Modules\LetterComponent\DTO\FragranceTypeDto;
use Modules\LetterComponent\Http\Cache\FragranceTypeCache;

class FragranceTypeService implements FragranceTypeServiceInterface
{
    public function get(string $id, ?array $relations = null)
    {
        try {
            return Cache::remember(FragranceTypeCache::GET . "_" . $id, FragranceTypeCache::GET_EXPIRY, function () use ($id, $relations) {
                return FragranceType::when(
                    $id,
                    fn($query, $id) => $query->where(FragranceType::id, $id)
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
            return Cache::remember(FragranceTypeCache::GET_ALL, FragranceTypeCache::GET_EXPIRY, function () use ($relations, $condsIn, $condsNotIn, $orderBy) {
                return FragranceType::when(
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

    public function create(FragranceTypeDto $fragranceTypeDto)
    {
        try {
            return FragranceType::create($fragranceTypeDto->toArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(FragranceTypeDto $fragranceTypeDto)
    {
        try {
            $fragranceType = $this->get($fragranceTypeDto->id);
            $fragranceType->fill($fragranceTypeDto->toArray());
            $fragranceType->save();

            return $fragranceType;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(string $id)
    {
        try {
            $fragranceType = $this->get($id);
            $name = $fragranceType->{FragranceType::name};
            $fragranceType->delete();

            return $name;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
