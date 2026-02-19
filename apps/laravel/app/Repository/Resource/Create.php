<?php

namespace App\Repository\Resource;

use Illuminate\Support\Facades\DB;
use App\Interfaces\RepositoryInterface;

/**
 * Создание записи в таблице ресурсов.
 */
class Create implements RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public static function query(array $data)
    {
        return auth()
            ->user()
            ->transports()
            ->findOrFail($data['transport_id'])
            ->events()
            ->findOrFail($data['event_id'])
            ->details()
            ->findOrFail($data['detail_id'])
            ->resources()
            ->create($data);
    }
}
