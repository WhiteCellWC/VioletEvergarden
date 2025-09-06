<?php

namespace App\Models;

class State extends BaseModel
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
}
