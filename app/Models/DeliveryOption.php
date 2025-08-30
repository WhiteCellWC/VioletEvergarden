<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOption extends Model
{
    const table = 'delivery_options';

    const id = 'id';

    const name = 'name';

    const isWeightBased = 'is_weight_based';

    const deliveryType = 'delivery_type';

    const estimatedDays = 'estimated_days';

    const hasTracking = 'has_tracking';

    const status = 'status';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'udpated_by';
    protected $fillable = [
        'name',
        'is_weight_based',
        'base_cost',
        'delivery_type',
        'estimated_days',
        'has_tracking',
        'status',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function letterDeliveries()
    {
        return $this->hasMany(LetterDelivery::class, LetterDelivery::deliveryOptionId);
    }

    public function deliveryTiers()
    {
        return $this->hasMany(DeliveryTier::class, DeliveryTier::deliveryOptionId);
    }
    #endregion
}
