<?php

namespace App\Repository\Detail;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class Get implements RepositoryInterface
{
    public static function query(array $data): Collection
    {
        $detail = auth()
            ->user()
            ->transports()
            ->findOrFail($data['transport_id'])
            ->events()
            ->findOrFail($data['event_id'])
            ->details();

        if (isset($data['id']))
            $detail->findOrFail($data['id']);
        
        return $detail
            ->with('resources')
            ->get();
    }
}
