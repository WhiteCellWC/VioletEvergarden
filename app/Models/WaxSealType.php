<?php

namespace App\Models;


class WaxSealType extends BaseModel
{
    const table = 'wax_seal_types';

    const id = 'id';

    const userId = 'user_id';

    const name = 'name';

    const color = 'color';

    const isCustom = 'is_custom';

    const price = 'price';

    const isPremium = 'is_premium';

    const discount = 'discount';

    const status = 'status';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'is_custom',
        'price',
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
        return $this->hasMany(LetterTemplate::class, LetterTemplate::waxSealTypeId);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class, Letter::waxSealTypeId);
    }

    public function user()
    {
        return $this->belongsTo(User::class, WaxSealType::userId);
    }

    public function images()
    {
        return $this->morphMany(CoreImage::class, 'imageable');
    }
    #endregion
}
