<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterPayment extends Model
{
    const id = 'id';

    const letterId = 'letter_id';

    const amount = 'amount';

    const paymentMethod = 'payment_method';

    const status = 'status';

    const transactionId = 'transaction_id';

    const paidAt = 'paid_at';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'letter_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
        'paid_at',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function letter()
    {
        return $this->belongsTo(Letter::class, LetterPayment::letterId);
    }
    #endregion
}
