<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: int implements HasLabel, HasColor
{
    case UNVERIFIED = 1;
    case VERIFIED = 2;
    case REJECTED = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::UNVERIFIED => 'Belum diverifikasi',
            self::VERIFIED => 'Terverifikasi',
            self::REJECTED => 'Ditolak',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::UNVERIFIED => 'warning',
            self::VERIFIED => 'success',
            self::REJECTED => 'danger',
        };
    }
}
