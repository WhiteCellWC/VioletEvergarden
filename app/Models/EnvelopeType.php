<?php

namespace App\Models;


class EnvelopeType extends BaseModel
{
    public const table = 'envelope_types';

    public const id = 'id';

    public const name = 'name';

    public const image = 'image';

    public const stock = 'stock';

    public const price = 'price';

    public const description = 'description';

    public const isPremium = 'is_premium';

    public const discount = 'discount';

    public const status = 'status';

    public const version = 'version';

    public const createdBy = 'created_by';

    public const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
        'image',
        'stock',
        'price',
        'description',
        'is_premium',
        'discount',
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
