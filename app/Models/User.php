<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserType;
use App\Models\Scopes\ActiveScope;
use App\Support\DateTime;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'type' => UserType::class,
        ];
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function isMidwife()
    {
        return $this->type === UserType::MIDWIFE;
    }

    public function isAdmin()
    {
        return $this->type === UserType::ADMIN || $this->type === UserType::OWNER;
    }

    public function isClient()
    {
        return $this->type === UserType::CLIENT;
    }

    public function isOwner()
    {
        return $this->type === UserType::OWNER;
    }

    public function kecamatans(): BelongsToMany
    {
        return $this->belongsToMany(Kecamatan::class, 'kecamatan_user', 'midwife_id', 'kecamatan_id')
            ->orderBy('name');
    }

    public function getAgeAttribute()
    {
        return DateTime::calculateAge($this->profile->dob);
    }

    // order untuk Bidan
    // schedules
    public function schedules(): HasMany
    {
        return $this->hasMany(Order::class, 'midwife_id');
    }

    // order untuk Client
    // reservations
    public function reservations(): HasMany
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class, 'treatment_user', 'midwife_id', 'treatment_id');
    }

    public function latestReservation(): HasOne
    {
        return $this->hasOne(Order::class, 'client_id')->latestOfMany();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_id');
    }

    public function getAddressAttribute()
    {
        return $this->addresses()->mainAddress()->select('id', 'kecamatan_id')->with('kecamatan:id,name')->first()
            ->kecamatan->name ?? NULL;
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class, 'client_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_user', 'client_id', 'tag_id');
    }

    public function scopeMidwives($query)
    {
        return $query->where('type', UserType::MIDWIFE);
    }

    public function scopeClients($query)
    {
        return $query->where('type', UserType::CLIENT);
    }
}
