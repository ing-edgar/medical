<?php

namespace App\Services\Status;

use App\Services\AppointmentStatusConcrete;
use JsonSerializable;

class Completed extends AppointmentStatusConcrete implements JsonSerializable
{
    public function getColor(): string
    {
        return 'completed';
    }

    public function getName(): string
    {
        return 'Completado';
    }
}
