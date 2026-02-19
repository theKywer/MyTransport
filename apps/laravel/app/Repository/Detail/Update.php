<?php

namespace App\Repository\Detail;

use App\Models\Event\Detail;
use App\Repository\Detail\CreateDetailRepository;

class Update
{
    public static function query(array $data)
    {
        return DB::transaction(function () use ($data) {
            $detail = auth()
                ->user()
                ->transports()
                ->findOrFail($data['transport_id'])
                ->events()
                ->findOrFail($data['event_id'])
                ->details()
                ->findOrFail($data['id']);
            $detail->update($data);

            if (isset($data['resources'])) {
                foreach ($data['resources'] as $resources) {
                    $detail->resources()->create($resources);
                }
            }

            return $detail->load('resources');
        });
    }
}
