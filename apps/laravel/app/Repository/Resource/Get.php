<?php

namespace App\Repository\Resource;

use App\Interfaces\RepositoryInterface;

/**
 * Получение записей из таблицы ресурсов
 */
class Get implements RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public static function query(array $data): Collection
    {
        $resource = auth()
            ->user()
            ->transports()
            ->findOrFail($data['transport_id'])
            ->events()
            ->findOrFail($data['event_id'])
            ->resources();

        if (isset($data['id']))
            $resource->findOrFail($data['id']);

        return $resource->get();
    }
}
