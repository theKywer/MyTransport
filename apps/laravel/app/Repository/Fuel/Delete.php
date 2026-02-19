<?php

namespace App\Repository\Fuel;

use App\Models\Event\Fuel;
use App\Interfaces\RepositoryInterface;

class Delete implements RepositoryInterface
{
    public static function query(array $data)
    {
        $fuel = Fuel::findOrFail($data['id'])
            ->whereHas('transport', function ($query) {
                $query->where('user_id', auth()->id());
            });
    }
}
