<?php

namespace App\Models;

class State extends BaseModel
{
    // Table Column Start
    public const table = 'states';

    public const id = 'id';

    public const name = 'name';

    public const countryId = 'country_id';

    public const version = 'version';

    public const createdBy = 'created_by';

    public const updatedBy = 'updated_by';
    // Table Column End

    // Relation Start
    public const country = 'country';
    // Relation End

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
