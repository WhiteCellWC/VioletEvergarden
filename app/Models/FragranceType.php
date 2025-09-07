<?php

namespace App\Models;

class FragranceType extends BaseModel
{
    public const table = 'fragrance_types';

    public const id = 'id';

    public const name = 'name';

    public const description = 'description';

    public const isPremium = 'is_premium';

    public const price = 'price';

    public const discount = 'discount';

    public const status = 'status';

    public const version = 'version';

    public const createdBy = 'created_by';

    public const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
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

    public function images()
    {
        return $this->morphMany(CoreImage::class, 'imageable');
    }
    #endregion
}
