<?php

namespace Database\Seeders;

use App\Models\AppointmentStatus;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppointmentStatus::insert(
            [
                [
                    'name' => 'Por confirmar',
                ],
                [
                    'name' => 'Confirmado'
                ],
                [
                    'name' => 'Reagendado'
                ],
                [
                    'name' => 'Cancelado'
                ],
            ]
        );
    }
}
