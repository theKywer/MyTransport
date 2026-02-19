<?php

namespace App\Repository\Transport;

use App\Interfaces\RepositoryInterface;

class Get implements RepositoryInterface
{
    public static function query(array $data)
    {
        $transport = auth()
            ->user()
            ->transports();

        if (isset($data['id']))
            $transport->findOrFail($data['id']);

        return $transport->get();
    }
}
