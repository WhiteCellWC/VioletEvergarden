<?php

namespace App\Models;

class FragranceType extends BaseModel
{
    const table = 'fragrance_types';

    const id = 'id';

    const name = 'name';

    const image = 'image';

    const description = 'description';

    const isPremium = 'is_premium';

    const price = 'price';

    const discount = 'discount';

    const status = 'status';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
        'image',
        'description',
        'is_premium',
        'price',
        'discount',
        'status',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function letterTemplates()
    {
        return $this->hasMany(LetterTemplate::class, LetterTemplate::fragranceTypeId);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class, Letter::fragranceTypeId);
    }
    #endregion
}
