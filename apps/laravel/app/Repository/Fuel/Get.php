<?php

namespace App\Repository\Fuel;

class Get
{
    public static function query(array $data)
    {
        $fuel = auth()
            ->user()
            ->transports()
            ->find($data['transport_id'])
            ->fuels();

        if (isset($data['id'])) 
            $fuel->find($data['id']);
        
        return $fuel->get();
    }
}
