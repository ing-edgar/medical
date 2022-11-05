<?php

namespace App\Services\Status;

use App\Services\AppointmentStatusConcrete;
use JsonSerializable;

class Registered extends AppointmentStatusConcrete implements JsonSerializable
{
    public function confirm()
    {
        $this->appointment->appointment_status = Confirmed::class;
        $this->appointment->update();
    }

    public function getName(): string
    {
        return 'Registrado';
    }

    public function getColor(): string
    {
        return 'registered';
    }
}
