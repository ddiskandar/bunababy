<?php

namespace App\Enums;

enum OrderStatus: int
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

}
