<?php

namespace App\Enum;

enum EventType: int 
{
    case FUEL = 1;
    case TIRESERVICE = 2;
    case DIAGNOSTICS = 3;
    case TUNNING = 4;
    case REPAIR = 5;

    public function label(): string
    {
        return match ($this) {
            self::FUEL => 'Fuel',
            self::TIRESERVICE => 'Tire service',
            self::DIAGNOSTICS => 'Diagnostics',
            self::TUNNING => 'Tunning',
            self::REPAIR => 'Repair'
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
