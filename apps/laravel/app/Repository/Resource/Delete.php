<?php

namespace App\Repository\Resource;

use App\Models\Event\Resource;

class Delete implements RepositoryInterface
{
    public static function query(array $data)
    {
        $resource = Resource::findOrFail($data['id'])
            ->whereHas('detail.event.transport', function ($query) {
                $query->where('user_id', auth()->id());
            });

        return $resource->delete();
    }
}
