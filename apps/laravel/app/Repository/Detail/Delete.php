<?php

namespace App\Repository\Detail;

use App\Models\Event\Detail;
use App\Interfaces\RepositoryInterface;

class Delete implements RepositoryInterface
{
    public static function query(array $data)
    {
        $detail = Detail::findOrFail($data['id'])
            ->whereHas('event.transport', function ($query) {
                $query->where('user_id', auth()->user()->id);
            });

        $detail->delete();
    }
}
