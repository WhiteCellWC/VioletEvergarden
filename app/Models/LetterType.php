<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    const table = 'letter_types';

    const id = 'id';

    const name = 'name';

    const status = 'status';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';
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
