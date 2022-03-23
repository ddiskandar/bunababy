<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const CLIENT    = 1;
    const MIDWIFE   = 2;
    const ADMIN     = 3;
    const OWNER     = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'photo',
        'ig',
        'active',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isMidwife()
    {
        return $this->type === self::MIDWIFE;
    }

    public function isAdmin()
    {
        return $this->type === self::ADMIN;
    }

    public function isClient()
    {
        return $this->type === self::CLIENT;
    }

    public function isOwner()
    {
        return $this->type === self::OWNER;
    }

    public function kecamatans(): BelongsToMany
    {
        return $this->belongsToMany(Kecamatan::class, 'kecamatan_user', 'midwife_user_id', 'kecamatan_id')->orderBy('name');
    }

    // order untuk Bidan
    // schedules
    public function schedules(): HasMany
    {
        return $this->hasMany(Order::class, 'midwife_user_id');
    }

    // order untuk Client
    // reservations
    public function reservations(): HasMany
    {
        return $this->hasMany(Order::class, 'client_user_id');
    }

    public function latestReservation()
{
    return $this->hasOne(Order::class, 'client_user_id')->latestOfMany();
}

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_user_id');
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class, 'client_user_id');
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->photo
                    ? asset('storage/' . $this->photo)
                    : $this->defaultProfilePhotoUrl();
    }

    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    protected $appends = [
        'profile_photo_url',
    ];

}
