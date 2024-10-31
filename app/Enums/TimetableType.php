<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TimetableType: int implements HasLabel, HasColor
{
    case LEAVE = 1;
    case OVERTIME = 2;
    case CLINIC = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::LEAVE => 'Izin',
            self::OVERTIME => 'Lembur',
            self::CLINIC => 'Klinik',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::LEAVE => 'warning',
            self::OVERTIME => 'success',
            self::CLINIC => 'primary',
        };
    }
}
