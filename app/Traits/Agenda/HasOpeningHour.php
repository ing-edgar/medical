<?php

namespace App\Traits\Agenda;

use App\Models\Weekday;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasOpeningHour
{
    public function weekdays(): BelongsToMany
    {
        return $this->belongsToMany(Weekday::class, 'opening_hours')->withPivot('value');
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
            $workingTimes[$openingHour['weekday_id']]['value'] = json_encode($openingHour['value']);
        }
        $this->weekdays()->sync($workingTimes, false);
    }
}
