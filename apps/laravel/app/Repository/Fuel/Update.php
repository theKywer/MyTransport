<?php

namespace App\Repository\Fuel;

class Update
{
    public static function query(array $data)
    {
        $fuel = auth()
            ->user()
            ->transports()
            ->find($data['transport_id'])
            ->fuels()
            ->find($data['id'])
            ->update($data);

        return $fuel;
    }
}
