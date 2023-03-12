<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'id',
        'name',
        'email',
        'password',
        'role',
        'phone',
        'photo',
        'ig',
        'type',
        'active',
        'google_id',
        'google_token',
        'google_refresh_token'
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
        'active' => 'boolean',
    ];

    protected $appends = [
        'profile_photo_url',
        'age'
    ];

    public function isMidwife()
    {
        return $this->type === self::MIDWIFE;
    }

    public function isAdmin()
    {
        return $this->type === self::ADMIN || $this->type === self::OWNER;
    }

    public function isClient()
    {
        return $this->type === self::CLIENT;
    }

    public function isOwner()
    {
        return $this->type === self::OWNER;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function kecamatans(): BelongsToMany
    {
        return $this->belongsToMany(Kecamatan::class, 'kecamatan_user', 'midwife_user_id', 'kecamatan_id')->orderBy('name');
    }

    public function getAgeAttribute()
    {
        return calculate_age($this->profile->dob);
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

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class, 'treatment_user', 'midwife_user_id', 'treatment_id');
    }

    public function latestReservation(): HasOne
    {
        return $this->hasOne(Order::class, 'client_user_id')->latestOfMany();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_user_id');
    }

    public function getAddressAttribute()
    {
        return $this->addresses()->mainAddress()->select('id', 'kecamatan_id')->with('kecamatan:id,name')->first()
            ->kecamatan->name ?? NULL;
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class, 'client_user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_user', 'client_user_id', 'tag_id');
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->google_id && $this->profile->photo
            ? $this->profile->photo
            : (isset($this->profile->photo)
                ? asset('storage/' . $this->profile->photo)
                : $this->defaultProfilePhotoUrl()
            );
    }

    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=FE0E9C&background=FCE7F3';
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeMidwives($query)
    {
        return $query->where('type', self::MIDWIFE);
    }

    public function scopeClients($query)
    {
        return $query->where('type', self::CLIENT);
    }

    public function testimonials()
    {
        return $this->hasManyThrough(
            Testimonial::class,
            Order::class,
            'client_user_id',
            'order_id',
            'id',
            'id'
        );
    }

    public function reviews()
    {
        return $this->hasManyThrough(
            Testimonial::class,
            Order::class,
            'midwife_user_id',
            'order_id',
            'id',
            'id'
        );
    }
}
