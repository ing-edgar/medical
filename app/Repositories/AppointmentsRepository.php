<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Collection;

class AppointmentsRepository
{

    public function getList(int $user_id, string $date): Collection
    {
        $appointments = Appointment::with('patient')->where(['user_id' => $user_id, 'date' => $date])->get();
        return $appointments;
    }
    public function getCount(int $user_id): Collection
    {
        $appointmentsCount = Appointment::selectRaw('count(date) as count, date, user_id')->groupBy(['date', 'user_id'])->where('user_id', $user_id)->get();
        return $appointmentsCount;
    }
}
