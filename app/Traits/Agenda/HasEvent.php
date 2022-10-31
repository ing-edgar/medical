<?php

namespace App\Traits\Agenda;

use App\Models\Event;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEvent
{

    /**
     * Get all of the comments for the HasEvent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
