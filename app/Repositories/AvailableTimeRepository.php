<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AvailableTimeRepository
{
  public function getWorkdaysByUser($user_id): Collection
  {
    return DB::table('user_workday')
      ->select(['workdays.id as workday_id', 'number_of_day', 'workdays.name', 'details'])
      ->rightJoin('users', 'user_workday.user_id', '=', 'users.id')
      ->rightJoin('workdays', 'user_workday.workday_id', '=', 'workdays.id')
      ->where('users.id', $user_id)
      ->orWhereNull('users.id')
      ->get();
  }

  public function getOfficeHourByUserId($user_id, $date)
  {
    $user = $this->getOfficeHours($date)->where('id', $user_id)->first();
    return $this->buildOfficeHours($user);
  }

  public function getOfficeHoursByUser($date): Collection
  {
    $users = $this->getOfficeHours($date)->with(['configurations' => function ($query) {
      $query->where('name', 'appointment_duration');
    }, 'patients' => function ($query) use ($date) {
      $query->where('date', $date);
    }])->get();
    $users = $users->map(function ($user) {
      $details = $this->buildOfficeHours($user);
      if (count($details) > 0) {
        return [
          'username' => $user->name,
          'user_id' => $user->id,
          'appointments' => $user->patients,
          'appointments_duration' => $user->configurations->first()->pivot->value,
          'intervals' => $details
        ];
      }
    });
    return $users->filter();
  }

  private function getOfficeHours($date): Builder
  {
    $day = Carbon::createFromFormat('Y-m-d', $date)->isoWeekday();
    return User::with(['officeHours' => function ($query) use ($day) {
      $query->where('workday_id', $day);
    }, 'officeHourEvents' => function ($query) use ($date) {
      $query->where('date', $date);
    }]);
  }

  private function buildOfficeHours($user)
  {
    $officeHourEvent = $user->officeHourEvents->first();
    $details = json_decode($officeHourEvent ? $officeHourEvent->details : '[]');

    if (!$officeHourEvent) {
      $officeHour = $user->officeHours->first();
      $details = json_decode($officeHour ? $officeHour->pivot->details : '[]');
    }
    return $details;
  }
}
