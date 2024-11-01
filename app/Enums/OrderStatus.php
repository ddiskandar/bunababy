<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: int implements HasLabel, HasColor, HasIcon
{
    case CANCELLED = 0;
    case PENDING = 1;
    case BOOKED = 2;
    case ON_HOLD = 4;
    case FINISHED = 6;
    case COMPLETED = 9;

    public function getLabel(): ?string
    {

        return match ($this) {
            self::CANCELLED => 'Dibatalkan',
            self::PENDING => 'Pending',
            self::BOOKED => 'Dijadwalkan',
            self::ON_HOLD => 'Ditunda',
            self::FINISHED => 'Dilayani',
            self::COMPLETED => 'Selesai',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::CANCELLED => 'danger',
            self::PENDING => 'danger',
            self::BOOKED => 'success',
            self::ON_HOLD => 'warning',
            self::FINISHED => 'primary',
            self::COMPLETED => 'info',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::CANCELLED => 'heroicon-m-x-circle',
            self::PENDING => 'heroicon-m-exclamation-circle',
            self::BOOKED => 'heroicon-m-bookmark',
            self::ON_HOLD => 'heroicon-m-pause-circle',
            self::FINISHED => 'heroicon-m-check-circle',
            self::COMPLETED => 'heroicon-m-check-badge',
        };
    }

}
