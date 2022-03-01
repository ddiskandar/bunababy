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
        'ig'
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

    public function kecamatans(): BelongsToMany
    {
        return $this->belongsToMany(Kecamatan::class, 'kecamatan_user', 'midwife_user_id', 'kecamatan_id');
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

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_user_id');
    }

}
