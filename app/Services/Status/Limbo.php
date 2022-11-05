<?php

namespace App\Services\Status;

use App\Services\AppointmentStatusConcrete;
use JsonSerializable;

class Limbo extends AppointmentStatusConcrete implements JsonSerializable
{
    public function confirm(): bool
    {
        $this->appointment->appointment_status = Confirmed::class;
        $this->appointment->update();
        return true;
    }

    public function getColor(): string
    {
        return 'canceled';
    }

    public function getName(): string
    {
        return 'Por asignar';
    }
}
