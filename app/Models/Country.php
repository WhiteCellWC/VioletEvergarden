<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    const table = 'countries';

    const id = 'id';

    const name = 'name';

    const isoCode = 'iso_code';

    const phoneCode = 'phone_code';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';
    protected $fillable = [
        'name',
        'iso_code',
        'phone_code',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function recipients()
    {
        return $this->hasMany(Recipient::class, Recipient::countryId);
    }

    public function states()
    {
        return $this->hasMany(State::class, State::countryId);
    }
    #endregion

    #region Scopes
    public function scopeCondsInByColumns($query, $columnMap)
    {
        if (!empty($columnMap) && count($columnMap) > 0) {
            foreach ($columnMap as $column => $value) {
                if ($this->isValidColumn($column) && $value) {
                    $query->where($column, 'LIKE', "%$value%");
                }
            }
        }

        return $query;
    }

    public function scropeCondsNotInByColumns($query, $columnMap)
    {
        if (!empty($columnMap) && count($columnMap) > 0) {
            foreach ($columnMap as $column => $value) {
                if ($this->isValidColumn($column) && $value) {
                    $query->where($column, '!=', $value);
                }
            }
        }

        return $query;
    }

    public function scopeOrderByColumns($query, $columnMap)
    {
        if (!empty($columnMap) && count($columnMap) > 0) {
            foreach ($columnMap as $column => $order) {
                if ($this->isValidColumn($column) && $order) {
                    $query->orderBy($column, $order);
                }
            }
        }
    }
    #endregion

    #region Private functions
    private function isValidColumn($column)
    {
        return in_array($column, $this->getFillable()) || in_array($column, $this->getGuarded());
    }
    #endregion
}
