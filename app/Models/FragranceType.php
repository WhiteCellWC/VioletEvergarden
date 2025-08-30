<?php

namespace App\Models;

use Hamcrest\Description;
use Illuminate\Database\Eloquent\Model;

class FragranceType extends Model
{
    const table = 'fragrance_types';

    const id = 'id';

    const image = 'image';

    const Description = 'description';

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
