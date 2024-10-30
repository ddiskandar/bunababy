<?php

namespace App\Enums;

enum TimetableType: int
{
    case LEAVE = 1;
    case OVERTIME = 2;
    case CLINIC = 3;
}
