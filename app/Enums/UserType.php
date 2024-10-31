<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserType: int implements HasLabel, HasColor
{
    case CLIENT = 1;
    case MIDWIFE = 2;
    case ADMIN = 3;
    case OWNER = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::CLIENT => 'Pelanggan',
            self::MIDWIFE => 'Bidan',
            self::ADMIN => 'Admin',
            self::OWNER => 'Owner',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::CLIENT => 'primary',
            self::MIDWIFE => 'success',
            self::ADMIN => 'danger',
            self::OWNER => 'warning',
        };
    }
}
