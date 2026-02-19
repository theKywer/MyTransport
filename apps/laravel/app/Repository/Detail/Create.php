<?php

namespace App\Repository\Detail;

use Illuminate\Support\Facades\DB;
use App\Interfaces\RepositoryInterface;

class Create
{
    public static function query(array $data)
    {
        return DB::transaction(function () use ($data) {
            $event = auth()
                ->user()
                ->transports()
                ->findOrFail($data['transport_id'])
                ->events()
                ->findOrFail($data['event_id']);

            $detail = $event->details()->create($data);

            if (isset($data['resources'])) {
                foreach ($data['resources'] as $resources) {
                    $detail->resources()->create($resources);
                }
            }

            return $detail->load('resources');
        });
    }
}
