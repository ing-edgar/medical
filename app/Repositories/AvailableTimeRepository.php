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

	public function getOfficeHoursByUser($user_id, $date): array
	{
		$user = $this->getOfficeHours($date)->with(['configurations' => function ($query) {
			$query->where('name', 'appointment_duration');
		}, 'appointments' => function ($query) use ($date) {
			$query->where('date', $date);
		}])->where('id', $user_id)->first();
		$details = $this->buildOfficeHours($user);
		if (count($details) > 0) {
			return [
				'username' => $user->name,
				'user_id' => $user->id,
				'appointments' => $user->appointments,
				'appointments_duration' => $user->configurations->first()->pivot->value,
				'intervals' => $details
			];
		}

		return [];
	}

	private function getOfficeHours($date): Builder
	{
		$day = Carbon::createFromFormat('Y-m-d', $date)->isoWeekday();
		return User::with(['weekdays' => function ($query) use ($day) {
			$query->where('weekday_id', $day);
		}, 'events' => function ($query) use ($date) {
			$query->where('date', $date);
		}]);
	}

	private function buildOfficeHours($user)
	{
		$officeHourEvent = $user->events->first();
		$values = json_decode($officeHourEvent ? $officeHourEvent->values : '[]');

		if (!$officeHourEvent) {
			$officeHour = $user->weekdays->first();
			$values = json_decode($officeHour ? $officeHour->pivot->values : '[]');
		}
		return $values;
	}
}
