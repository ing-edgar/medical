<?php

namespace App\Traits\Agenda;

use App\Models\ConfigType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasConfiguration
{
    /**
     * The roles that belong to the HasConfiguration
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function configurations(): BelongsToMany
    {
        return $this->belongsToMany(ConfigType::class, table: 'configurations')->withPivot('value');;
    }

    public function addConfiguration(array $configurations)
    {
        $temp_configurations = [];
        foreach ($configurations as $configuration) {
            $temp_configurations[$configuration['id']]['value'] = json_encode($configuration['value']);
        }
        $this->configurations()->sync($temp_configurations, false);
    }
}
