<?php

namespace App\Models;

class Letter extends BaseModel
{
    const table = 'letters';

    const id = 'id';

    const userId = 'user_id';

    const title = 'title';

    const body = 'body';

    const sendType = 'send_type';

    const paperTypeId = 'paper_type_id';

    const fragranceTypeId = 'fragrance_type_id';

    const envelopeTypeId = 'envelope_type_id';

    const waxSealTypeId = 'wax_seal_type_id';

    const isDraft = 'is_draft';

    const isSent = 'is_sent';

    const isSealed = 'is_sealed';

    const isPrinted = 'is_printed';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'send_type',
        'paper_type_id',
        'fragrance_type_id',
        'envelope_type_id',
        'wax_seal_type_id',
        'is_draft',
        'is_sent',
        'is_sealed',
        'is_printed',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function waxSealType()
    {
        return $this->belongsTo(WaxSealType::class, Letter::waxSealTypeId);
    }

    public function letterTypes()
    {
        return $this->belongsToMany(LetterType::class);
    }

    public function paperType()
    {
        return $this->belongsTo(PaperType::class, Letter::paperTypeId);
    }

    public function fragranceType()
    {
        return $this->belongsTo(FragranceType::class, Letter::fragranceTypeId);
    }

    public function envelopeType()
    {
        return $this->belongsTo(EnvelopeType::class, Letter::envelopeTypeId);
    }

    public function letterPayments()
    {
        return $this->hasMany(LetterPayment::class, LetterPayment::letterId);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class, Recipient::letterId);
    }

    public function user()
    {
        return $this->belongsTo(User::class, Letter::userId);
    }
    #endregion
}
