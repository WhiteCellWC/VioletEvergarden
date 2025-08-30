<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvelopeType extends Model
{
    const table = 'envelope_types';

    const id = 'id';

    const image = 'image';

    const stock = 'stock';

    const price = 'price';

    const description = 'description';

    const isPremium = 'is_premium';

    const status = 'status';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
        'image',
        'stock',
        'price',
        'description',
        'is_premium',
        'status',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function letterTemplates()
    {
        return $this->hasMany(LetterTemplate::class, LetterTemplate::envelopeTypeId);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class, Letter::envelopeTypeId);
    }
    #endregion
}
