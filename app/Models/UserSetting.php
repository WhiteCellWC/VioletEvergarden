<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    const id = 'id';

    const userId = 'user_id';

    const keyName = 'key_name';

    const keyValue = 'key_value';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    protected $fillable = [
        'user_id',
        'key_name',
        'key_value',
        'version',
        'created_by',
        'updated_by'
    ];

    #region Relations
    public function user()
    {
        return $this->belongsTo(User::class, UserSetting::userId);
    }
    #endregion
}
