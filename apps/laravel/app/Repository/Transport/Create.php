<?php

namespace App\Repository\Transport;

use App\Interfaces\RepositoryInterface;

class Create implements RepositoryInterface
{
    public static function query(array $data)
    {
        return auth()
            ->user()
            ->transports()
            ->create($data);
    }
}
