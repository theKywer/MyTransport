<?php

namespace App\Enum;

enum TransportType: int 
{
    case CAR = 1;
    case MOTO = 2;
    case TRUCK = 3;
    case BUS = 4;

    public function label(): string
    {
        return match ($this) {
            self::CAR => 'Car',
            self::MOTO => 'Moto',
            self::TRUCK => 'Truck',
            self::BUS => 'Bus',
        };
    }

    public static function getLabels(): array
    {
        return array_map(fn($case) => $case->label(), self::cases());
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}