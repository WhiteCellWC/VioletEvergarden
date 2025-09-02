<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
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
