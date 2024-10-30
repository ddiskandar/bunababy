<?php

namespace App\Enums;

enum UserType: int
{
    case CLIENT = 1;
    case MIDWIFE = 2;
    case ADMIN = 3;
    case OWNER = 4;
}
