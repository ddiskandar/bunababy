<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case UNVERIFIED = 1;
    case VERIFIED = 2;
    case REJECTED = 3;
}
