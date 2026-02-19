<?php

namespace App\Repository\Event;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Получение записей событий с деталями и ресурсами.
 */
class Get implements RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public static function query(array $data): Collection
    {
        $events = auth()
            ->user()
            ->transports()
            ->findOrFail($data['transport_id'])
            ->events();

        if (isset($data['id']))
            $events
                ->findOrFail($data['id']);
        
        return $events
            ->with('details.resources')
            ->get();
    }
}
