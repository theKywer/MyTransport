<?php

namespace App\Repository\Event;

use App\Models\Event\Event;
use App\Models\Event\Detail;
use App\Models\Event\Resource;
use Illuminate\Support\Facades\DB;
use App\Models\Transport\Transport;
use App\Interfaces\RepositoryInterface;

/**
 * Обновление записи события. Транзакция обновляет записи в следующие модели:
 * - {@see Transport::mileage}
 * - {@see Event}
 * - {@see Detail}
 * - {@see Resource}
 */
class Update implements RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public static function query(array $data)
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
                ->findOrFail($data['event_id']);
            
            $event
                ->update($data);

            if (isset($data['details'])) {
                foreach ($data['details'] as $details) {
                    $detail = $event
                        ->details()
                        ->updateOrCreate(['event_id' => $event->id], $detail);
                    
                    if (isset($details['resources'])) {
                        foreach ($details['resources'] as $resource) {
                            $detail
                                ->resources()
                                ->updateOrCreate(['detail_id' => $detail['id']], $resource);
                        }
                    }
                }
            }

            return $event->load('details', 'resources');
        });
    }
}
