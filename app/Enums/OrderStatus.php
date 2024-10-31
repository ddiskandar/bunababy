<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: int implements HasLabel, HasColor
{
    case UNPAID = 1;
    case LOCKED = 2;
    case FINISHED = 3;

    public function getLabel(): ?string
    {

        return match ($this) {
            self::UNPAID => 'Unpaid',
            self::LOCKED => 'Locked',
            self::FINISHED => 'Finished',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::UNPAID => 'warning',
            self::LOCKED => 'danger',
            self::FINISHED => 'success',
        };
    }

}
