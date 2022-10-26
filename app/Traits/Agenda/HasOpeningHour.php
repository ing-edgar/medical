<?php

namespace App\Traits\Agenda;

use App\Models\Weekday;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasOpeningHour
{
    public function weekdays(): BelongsToMany
    {
        return $this->belongsToMany(Weekday::class, 'opening_hours')->withPivot('values');
    }

    public function openingHours()
    {
        return $this->weekdays()->get();
    }

    public function addOpeningHour(array $deleted_ids, array $openingHours)
    {
        $workingTimes = [];
        // Eliminamos todos los elementos que se encuentren dentro de nuestro arreglo
        $this->weekdays()->detach($deleted_ids);
        foreach ($openingHours as $openingHour) {
            $workingTimes[$openingHour['weekday_id']]['values'] = json_encode($openingHour['values']);
        }
        $this->weekdays()->sync($workingTimes, false);
    }
}
