<?php

namespace App\Repository\Event;

use App\Models\Event\Detail;
use App\Models\Event\Event;
use App\Models\Event\Resource;
use App\Models\Transport\Transport;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Создание записи события. Транзакция создаёт записи в следующие модели:
 * - {@see Transport::mileage}
 * - {@see Event}
 * - {@see Detail}
 * - {@see Resource}
 */
class Create implements RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public static function query(array $data): Event
    {
        $transport = auth()
            ->user()
            ->transports()
            ->findOrFail($data['transport_id']);

        return DB::transaction(function () use ($data, $transport) {
            $transport
                ->update(['mileage' => $data['mileage']]);

            $event = $transport
                ->events()
                ->create($data);

            if (isset($data['details'])) {
                foreach ($data['details'] as $details) {
                    $detail = $event
                        ->details()
                        ->create($details);

                    if (isset($details['resources'])) {
                        foreach ($details['resources'] as $resource) {
                            $detail
                                ->resources()
                                ->create($resource);
                        }
                    }
                }
            }

            return $event->load('details.resources');
        });
    }
}
