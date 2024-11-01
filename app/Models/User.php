<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserType;
use App\Models\Scopes\ActiveScope;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        static::addGlobalScopes([ActiveScope::class]);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    // public function isMidwife()
    // {
    //     return $this->type === UserType::MIDWIFE;
    // }

    // public function isAdminAttribute(): bool
    // {
    //     return $this->type === UserType::ADMIN || $this->type === UserType::OWNER;
    // }

    // public function isCustomerAttribute(): bool
    // {
    //     return $this->type === UserType::CUSTOMER;
    // }

    // public function isOwnerAttribute(): bool
    // {
    //     return $this->type === UserType::OWNER;
    // }

    public function scopeOwners($query)
    {
        return $query->where('type', UserType::OWNER);
    }

    public function scopeMidwives($query)
    {
        return $query->where('type', UserType::MIDWIFE);
    }

    public function scopeCustomers($query)
    {
        return $query->where('type', UserType::CUSTOMER);
    }
}
