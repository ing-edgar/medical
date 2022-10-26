<?php

namespace Database\Seeders;

use App\Models\ConfigType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigType::insert([
            [
                'name'       => 'appointment_duration',
                'label'      => 'Duración de la cita',
                'input_type' => 'select'
            ],

        ]);
    }
}
