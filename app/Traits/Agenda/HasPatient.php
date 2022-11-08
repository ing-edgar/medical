<?php

namespace App\Traits\Agenda;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPatient
{

    /**
     * The patients that belong to the HasPatient
     *
     * @return BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class);
    }
}
