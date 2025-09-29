<?php

namespace App\Models;


class EnvelopeType extends BaseModel
{
    // Table Column Start
    public const table = 'envelope_types';

    public const id = 'id';

    public const name = 'name';

    public const stock = 'stock';

    public const price = 'price';

    public const description = 'description';

    public const isPremium = 'is_premium';

    public const discount = 'discount';

    public const status = 'status';

    public const version = 'version';

    public const createdBy = 'created_by';

    public const updatedBy = 'updated_by';
    // Table Column End

    // Relation Start
    public const images = 'images';
    // Relation End

    protected $fillable = [
        'name',
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

    public function images()
    {
        return $this->morphMany(CoreImage::class, 'imageable');
    }
    #endregion
}
