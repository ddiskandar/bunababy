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

    public function scopeOwners($query)
    {
        return $query->where('type', UserType::OWNER);
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
