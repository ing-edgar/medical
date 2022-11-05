<?php

namespace App\Services\Status;

use App\Services\AppointmentStatusConcrete;
use JsonSerializable;

class Confirmed extends AppointmentStatusConcrete implements JsonSerializable
{
    public function cancel(): bool
    {
        $this->appointment->appointment_status = Limbo::class;
        $this->appointment->update();
        return true;
    }

    public function complete(): bool
    {
        $this->appointment->appointment_status = Completed::class;
        $this->appointment->update();
        return true;
    }

    public function getColor(): string
    {
        return "confirmed";
    }

    public function getName(): string
    {
        return 'Confirmado';
    }

    
}
