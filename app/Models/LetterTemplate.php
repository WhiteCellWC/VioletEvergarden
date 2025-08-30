<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterTemplate extends Model
{
    const table = 'letter_templates';

    const id = 'id';

    const name = 'name';

    const description = 'description';

    const sendType = 'send_type';

    const paperTypeId = 'paper_type_id';

    const fragranceTypeId = 'fragrance_type_id';

    const envelopeTypeId = 'envelope_type_id';

    const waxSealTypeId = 'wax_seal_type_id';

    const status = 'status';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'name',
        'description',
        'send_type',
        'paper_type_id',
        'fragrance_type_id',
        'envelope_type_id',
        'wax_seal_type_id',
        'status',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function paperType()
    {
        return $this->belongsTo(PaperType::class, LetterTemplate::paperTypeId);
    }

    public function letterTypes()
    {
        return $this->belongsToMany(LetterType::class);
    }

    public function waxSealType()
    {
        return $this->belongsTo(WaxSealType::class, LetterTemplate::waxSealTypeId);
    }

    public function fragranceType()
    {
        return $this->belongsTo(FragranceType::class, LetterTemplate::fragranceTypeId);
    }

    public function envelopeType()
    {
        return $this->belongsTo(EnvelopeType::class, LetterTemplate::envelopeTypeId);
    }
    #endregion
}
