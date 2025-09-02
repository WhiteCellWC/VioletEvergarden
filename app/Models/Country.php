<?php

namespace App\Models;


class Country extends BaseModel
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
}
