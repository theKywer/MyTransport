<?php

namespace App\Repository\Resource;

use App\Models\Event\Resource;
use App\Interfaces\RepositoryInterface;

/**
 * Обновление записи в таблице ресурсов.
 */
class Update implements RepositoryInterface
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
            ->update($validated);
    }
}
