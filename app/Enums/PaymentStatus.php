<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case Pending = 1;
    case Payed   = 2;
}
