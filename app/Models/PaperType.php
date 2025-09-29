<?php

namespace App\Models;

class PaperType extends BaseModel
{
    // Table Column Start
    const table = 'paper_types';

    const id = 'id';

    const name = 'name';

    const stock = 'stock';

    const pricePerPage = 'price_per_page';

    const description = 'description';

    const isPremium = 'is_premium';

    const discount = 'discount';

    const status = 'status';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';
    // Table Column End

    // Relation Start
    public const images = 'images';
    // Relation End

    protected $fillable = [
        'name',
        'stock',
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

    public function images()
    {
        return $this->morphMany(CoreImage::class, 'imageable');
    }
    #endregion
}
