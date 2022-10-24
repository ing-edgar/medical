<?php

namespace App\Traits\Agenda;

trait HasAgenda
{
    use HasEvent, HasAppointment, HasConfiguration, HasOpeningHour;
}
