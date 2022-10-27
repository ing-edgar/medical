<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::insert(
            [
                [
                    'name' => 'Pendiente',
                ],
                [
                    'name' => 'Pagado'
                ],
            ]
        );
    }
}
