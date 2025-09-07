<?php

namespace App\Models;

class PaperType extends BaseModel
{
    const table = 'paper_types';

    const id = 'id';

    const name = 'name';

    const image = 'image';

    const stock = 'stock';

    const gradient = 'gradient';

    const pricePerPage = 'price_per_page';

    const description = 'description';

    const isPremium = 'is_premium';

    const discount = 'discount';

    const status = 'status';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
        'image',
        'stock',
        'gradient',
        'price_per_page',
        'description',
        'is_premium',
        'discount',
        'status',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function letters()
    {
        return $this->hasMany(Letter::class, Letter::paperTypeId);
    }

    public function letterTemplates()
    {
        return $this->hasMany(LetterTemplate::class, LetterTemplate::paperTypeId);
    }
    #endregion
}
