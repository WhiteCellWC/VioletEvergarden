<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const table = 'users';

    const id = 'id';

    const name = 'name';

    const email = 'email';

    const password = 'password';

    const dateOfBirth = 'date_of_birth';

    const gender = 'gender';

    const profileImage = 'profile_image';

    const bio = 'bio';

    const version = 'version';

    const createdBy = 'created_by';

    const updatedBy = 'updated_by';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'gender',
        'profile_image',
        'bio',
        'version',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    #region Relations
    public function notifications()
    {
        return $this->hasMany(Notification::class, Notification::userId);
    }

    public function settings()
    {
        return $this->hasMany(UserSetting::class, UserSetting::userId);
    }

    public function waxSealTypes()
    {
        return $this->hasMany(WaxSealType::class, WaxSealType::userId);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class, Letter::userId);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class, Recipient::userId);
    }
    #endregion
}
