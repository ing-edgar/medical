<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AvailableTimeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AvailableTime
{
  private Carbon $carbon;
  private $today;

  public function build(Request $request): array
  {
    $this->carbon = Carbon::createFromFormat('Y-m-d', $request->get('date'));
    $this->today = $this->carbon->copy()->now();

    $workdayRepository = new AvailableTimeRepository();
    $users = $workdayRepository
      ->getOfficeHoursByUser(
        $request->get('user_id'),
        $request->get('date')
      );
    return $this->create($users);
  }

  private function create(array $user): array
  {

    return [
      'username' => $user['username'],
      'user_id' => $user['user_id'],
      'availables' => $this->buildAvailables($user)
    ];
  }

  private function buildAvailables($user): array
  {
    $available = [];
    $intervals = $this->buildIntervals($user['intervals'], $user['appointments_duration']);
    foreach ($intervals as $interval) {
      $appointment_count = $user['appointments']?->where('pivot.start_time', $interval['start_time'])->where('pivot.end_time', $interval['end_time'])->count();
      if ($appointment_count <= 0) {
        $available[] = [
          'interval' => $interval['start_time'] . '-' . $interval['end_time'],
          'start_time' => $interval['start_time'],
          'end_time' => $interval['end_time']
        ];
      }
    }

    return $available;
  }

  private function buildIntervals(array $intervals, int $appointment_duration): array
  {
    $intervals_by_user = [];
    foreach ($intervals as $interval) {
      $startTime = $this->createDate($interval->start_time);
      $endTime = $this->createDate($interval->end_time);
      $intervals_founded =  $this->findRanges($startTime, $endTime, $appointment_duration);
      foreach ($intervals_founded as $interval) {
        array_push($intervals_by_user, $interval);
      }
    }
    return $intervals_by_user;
  }

  /**
   * ------------------------------------------------------------------------
   * Construye una instancia de Carbon a partir de una fecha dada
   * @param string $hour la hora de una jornada laboral
   * @return Carbon instancia de la fecha
   * ------------------------------------------------------------------------
   */
  private function createDate(string $hour): Carbon
  {
    return $this->carbon->copy()->createFromFormat(
      'Y-m-d h:i A',
      $this->carbon->format('Y-m-d') . ' ' . $hour
    );
  }

  /**
   * ------------------------------------------------------------------------
   * Calcula las horas disponibles que tiene un profesional
   * con base en su agenda.
   * @param Carbon $startTime La hora laboral de inicio
   * @param Carbon $endTime La hora laboral final
   * @return array Horas disponibles
   * ------------------------------------------------------------------------
   */
  private function findRanges(Carbon $startTime, Carbon $endTime, $value): array
  {
    $rangeHours = [];
    while ($startTime->lessThan($endTime)) {
      if (!$this->isHourInRange($startTime)) {
        $startTime->addMinutes($value);
        continue;
      }
      $rangeHours[] = [
        'start_time' => $startTime->format('h:i A'),
        'end_time' => $startTime->addMinutes($value)->lessThan($endTime) ? $startTime->format('h:i A') : $endTime->format('h:i A'),
      ];
    }
    return $rangeHours;
  }

  private function isHourInRange(Carbon $date): bool
  {
    if ($this->today->isSameDay($date)) {
      $date = $date->copy();
      return $this->today->diffInMinutes($date, false) > 60;
    }
    return $this->today->lt($date);
  }
}
