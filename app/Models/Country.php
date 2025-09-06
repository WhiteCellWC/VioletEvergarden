<?php

namespace App\Models;


class Country extends BaseModel
{
    public const table = 'countries';

    public const id = 'id';

    public const name = 'name';

    public const isoCode = 'iso_code';

    public const phoneCode = 'phone_code';

    public const version = 'version';

    public const createdBy = 'created_by';

    public const updatedBy = 'updated_by';

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
