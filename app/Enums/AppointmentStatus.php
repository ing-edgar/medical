<?php

namespace App\Enums;

enum AppointmentStatus: int
{
    case Unconfirmed = 1;
    case Confirmed   = 2;
    case Canceled    = 3;
    case Rescheduled = 4;
    case Absent      = 5;
}
