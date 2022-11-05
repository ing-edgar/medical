<?php

namespace App\Services\Interfaces;

interface PaymentStatusInterface
{
    public function unpayed(): bool;
    public function payed(): bool;
    public function canceled(): bool;
    public function getColor(): string;
    public function getName(): string;
}
