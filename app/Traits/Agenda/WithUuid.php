<?php


namespace App\Traits\Agenda;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait WithUuid
{
    public function initializeHasUuid()
    {
        $this->incrementing = false;
        $this->keyType = 'string';
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)Str::uuid();
        });
    }
}
