<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const id = 'id';

    const userId = 'user_id';

    const title = 'title';

    const content = 'content';

    const link = 'link';

    const type = 'type';

    const status = 'status';

    const sentAt = 'sent_at';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'link',
        'type',
        'status',
        'sent_at',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function user()
    {
        return $this->belongsTo(User::class, Notification::userId);
    }
    #endregion
}
