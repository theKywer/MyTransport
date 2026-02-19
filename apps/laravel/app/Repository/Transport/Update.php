<?php

namespace App\Repository\Transport;

use App\Interfaces\RepositoryInterface;

class Update implements RepositoryInterface
{
    public static function query(array $data)
    {
        $transport = auth()
            ->user()
            ->transports()
            ->findOrFail($data['id']);
        
        $transport->update($data);

        return $transport;
    }
}
