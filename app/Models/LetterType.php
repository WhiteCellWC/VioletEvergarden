<?php

namespace App\Models;

class LetterType extends BaseModel
{
    public const table = 'letter_types';

    public const id = 'id';

    public const name = 'name';

    public const status = 'status';

    public const version = 'version';

    public const createdBy = 'created_by';

    public const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
        'status',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function letters()
    {
        return $this->belongsToMany(Letter::class);
    }

    public function letterTemplates()
    {
        return $this->belongsToMany(LetterTemplate::class);
    }
    #endregion
}
