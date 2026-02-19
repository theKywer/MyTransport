<?php

namespace App\Repository\Fuel;

class Create
{
    public static function query(array $data)
    {
        $fuel = auth()
            ->user()
            ->transports()
            ->find($data['transport_id'])
            ->fuels()
            ->create($data);

        return $fuel;
    }
}
