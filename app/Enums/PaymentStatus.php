<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case Payed   = 1;
    case Pending = 2;
}
