<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    const table = 'states';

    const id = 'id';

    const name = 'name';

    const countryId = 'country_id';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
        'country_id',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function country()
    {
        return $this->belongsTo(Country::class, State::countryId);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class, Recipient::stateId);
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
